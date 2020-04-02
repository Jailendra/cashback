<?php

namespace App\Services\API;

use App\Apis\TradeTracker as API;

class TradeTracker {

    const SERVICE_NAME = 'tradetracker';
    const ASSIGN_STATUS = 'accepted';
    const PROPOSALS_DIRECTORY = 'aggregators/proposals/tradetracker';

    private $api;
    private $service;

    public function __construct (API $api, ProposalStorageService $service) {
        $this->api = $api;
        $this->service = $service;
        $this->service->setDirectory (self::PROPOSALS_DIRECTORY);
    }

    public function getAdvertisers (array $params):object {
        return (object) $this->api->advertisers (['assignmentStatus' => self::ASSIGN_STATUS]);
    }

    /**
     * Method to search for product offers
     */
    public function getProposals (array $advertisers, array $params) {
        $proposals = array_values (array_filter (array_map (function ($advertiserId) {
            $advertiserOffers = (array) $this->proposalDetail($advertiserId);
            if (count($advertiserOffers)) {
                $offer = current($advertiserOffers);
                $offer->total = count($advertiserOffers);
                return $offer;
            }
        }, $advertisers)));

        return (object) [
            'links' => [
                '@attributes' => $this->proposalPagination (count ($advertisers), $params),
                'link' => $proposals
            ]
        ];
    }

    private function proposalPagination (int $returnResult, array $params):object  {
        return (object) [
            "total-matched" => $params['total'],
            "records-returned" => $returnResult,
            "page-number" => $params['page']
        ];
    }

    public function proposalDetail (int $advertiserId) {
        if ($this->service->checkAdvertiserResourceExtsts($advertiserId)) {
            return json_decode ($this->service->retrieveAdvertiserResource ($advertiserId));
        }
         
        return $this->fetchAdvertiserOffer ($advertiserId);
    }

    /**
     * fetch advertiser offer from API and cache API response
     */
    private function fetchAdvertiserOffer (int $advertiserId):?object {
        // fetch API response from Commission-junction
        $proposals = (object) $this->api->proposals (['campaignID' => $advertiserId]);

        // proposals not found
        if (!$proposals)
            return null;

        // save offer as cache
        $this->service->saveAdvertiserResponse ($advertiserId, $proposals);
        return (object) $proposals;
    }

    /**
     * Method to fetch commission detail
     */
    public function getCommission ():object {
        $params = ['billDateFrom' => date('Y-m-d', strtotime('-1 days')), 'billDateTo' => date('Y-m-d')];
        return (object) $this->api->commission(json_encode($params));
    }
}