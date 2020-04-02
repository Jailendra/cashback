<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\Proposal as ProposalTrait;

class ProposalService {

    use ProposalTrait;

    private $advertiserService;
    private $apiService;

    public function __construct (APIService $apiService, AdvertiserService $advertiserService) {
        $this->advertiserService = $advertiserService;
        $this->apiService = $apiService;
    }

    /**
     * Method to get proposals from aggregators into json format
     */
    public function getProposalJson (Request $request) {
        return array_map (function ($proposal) {
            return $proposal->toArray();
        }, $this->getProposals ($request));
    }

    /**
     * Method to fetch proposals belongs to active-aggregator
     */
    public function getProposals (Request $request):array {
        $activeAdvertisors = $this->advertiserService->getActiveAggregatorAdvertisor ($request->input('limit', env('PAGINATION_LIMIT', 10)), $request->input('category', null));
        
        $advertisors = $activeAdvertisors->count() ? $this->groupAdvertiserByAggregator ($activeAdvertisors) : [];
        $params = ['page' => $activeAdvertisors->currentPage(), 'total' => $activeAdvertisors->total()];

        return array_reduce (array_map (function ($aggregatorName, $advertisors) use ($params) {
            $proposals = $this->apiService->parseProposals ($aggregatorName ,$this->apiService->listProposal ($aggregatorName, array_column ($advertisors, 'advertiser_id'), $params));
            $this->setAdvertiserData ($advertisors, $proposals, $aggregatorName);
            return $proposals;
        }, array_keys ($advertisors), $advertisors), 'array_merge', []);
    }

    /**
     * Method to get proposal detail of an advertiser
     */
    public function getProposalDetail (Request $request):array {
        $advertiser = $this->advertiserService->getAdvertiserById ((int) $request->route()->parameter('advertiserId'));
        $aggregator = $advertiser->aggregator()->first();
        $proposals = $this->apiService->proposalDetail ($aggregator->name, $request->route()->parameter('advertiserId'));

        return [
            'paginate' => $this->apiService->parsePagination ($aggregator->name, $proposals),
            'proposals' => $this->updateDetail ($aggregator->name, $this->apiService->parseProposalDetail ($aggregator->name, $proposals), $advertiser, $request->user()),
            'advertiser' => $advertiser
        ];
    }
}