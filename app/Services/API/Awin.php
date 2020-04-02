<?php

namespace App\Services\API;

use App\Apis\Awin as API;

class Awin {
    const SERVICE_NAME = 'awin';
    const PROPOSALS_DIRECTORY = 'aggregators/proposals/awin';

    private $api;

    public function __construct (API $api, ProposalStorageService $service) {
        $this->api = $api;
        $this->service = $service;
        $this->service->setDirectory (self::PROPOSALS_DIRECTORY);
    }

    public function getAdvertisers (array $params) {
        return (object) (json_decode ($this->api->advertisers (['type' => 'advertiser'])))->accounts;
    }

    /**
     * Method to search for product offers
     */
    public function getProposals (array $advertisers, array $params) {
        $proposals = array_values (array_filter (array_map (function ($advertiserId) {
            return (array) $this->proposalDetail($advertiserId);
        }, $advertisers)));

        return (object) [
            'links' => [
                '@attributes' => $this->proposalPagination (count ($advertisers), $params),
                'link' => $proposals
            ]
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
        $proposals = (object) (json_decode($this->api->proposals (['advertiserId' => $advertiserId])));

        // proposals not found
        if (!$proposals)
            return null;

        // save offer as cache
        $this->service->saveAdvertiserResponse ($advertiserId, $proposals);
        return (object) $proposals;
    }

    private function proposalPagination (int $returnResult, array $params):object  {
        return (object) [
            "total-matched" => $params['total'],
            "records-returned" => $returnResult,
            "page-number" => $params['page']
        ];
    }

    /**
     * Method to fetch commission detail
     */
    public function getCommission ():object {
        $params = ['startDate' => (new \DateTime('-1 days'))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s'), 'endDate' => (new \DateTime())->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s'), 'timezone' => 'UTC', 'dateType' => 'transaction', 'status' => 'approved'];
        return (object) json_decode ($this->api->commission(json_encode($params)));
    }
}