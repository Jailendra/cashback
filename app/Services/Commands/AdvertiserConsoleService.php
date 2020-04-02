<?php

namespace App\Services\Commands;

use App\Services\Parsers\API\IAdvertiser;
use App\Repositories\Advertiser\IAdvertiserRepository as Repository;
use App\Services\Parsers\API\IPagination;
use App\Services\APIService;

class AdvertiserConsoleService {
    
    private $apiService;
    private $repository;

    const FIRST_PAGE = 1;
    const MAXIMUM_PAGINATION_LIMIT = 100;

    public function __construct (Repository $repository, APIService $apiService) {
        $this->apiService = $apiService;
        $this->repository = $repository;
    }

    /**
     * Method to save advertisers
     */
    public function saveAdvertisers (array $aggregator, array $params = ['page' => self::FIRST_PAGE, 'limit' => self::MAXIMUM_PAGINATION_LIMIT]) {
        $advertisers = $this->getAdvertisers ($aggregator, $params);
        $this->saveAdvertiser ($advertisers['advertisers'], $aggregator['id']);

        if ($params = $this->checkRecursion ($advertisers['paginate'])) {
            $this->saveAdvertisers ($aggregator, $params);
        }
    }

    /**
     * Method to check if recursion call required for pagination
     */
    private function checkRecursion (IPagination $paginate):?array {
        if ($paginate->total () > ($paginate->currentPage () * self::MAXIMUM_PAGINATION_LIMIT)) {
            return ['page' => ($paginate->currentPage () + 1), 'limit' => self::MAXIMUM_PAGINATION_LIMIT];
        }
        return null;
    }

    private function saveAdvertiser (array $advertisers, int $aggregatorId) {
        array_walk ($advertisers, function ($advertiser) use ($aggregatorId) {
            $this->updateOrCreateAdvertiser ($advertiser, $aggregatorId);
        });
    }

    private function updateOrCreateAdvertiser (IAdvertiser $advertiser, int $aggregatorId) {
        return $this->repository->updateOrCreate ([
            'advertiser_id' => $advertiser->id()
        ], [
            'status' => $advertiser->status(),
            'advertiser_name' => $advertiser->name(),
            'categories' => $advertiser->categories(),
            'aggregator_id' => $aggregatorId,
            'image' => $advertiser->image(),
            'commission' => $advertiser->commission(),
            'start_at' => $advertiser->startDate(),
            'end_at' => $advertiser->endDate(),
        ]);
    }

    private function getAdvertisers (array $aggregator, array $params):array {
        try {
            $advertisers = $this->apiService->getAdvertisers ($aggregator['name'], $params);
        } catch (\Exception $ex) {
            return $this->saveAdvertisers ($aggregator, $params);
        } finally {
            return [
                'paginate' => $this->apiService->parsePagination ($aggregator['name'], $advertisers),
                'advertisers' => $this->apiService->parseAdvertisers ($aggregator['name'], $advertisers)
            ];
        }
    }
}