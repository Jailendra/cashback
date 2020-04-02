<?php

namespace App\Services\API;

use App\Apis\CommissionJunction as API;
use App\Traits\CJParams;

class CommissionJunction {

    use CJParams;

    const SERVICE_NAME = 'commission Junction';
    const PROPOSALS_DIRECTORY = 'aggregators/proposals/commission-junction';
    const MAX_API_PAGINATION_LIMIT = 100;       // maximum limit to call CJ offer
    const DEFAULT_PAGE = 1;                     // first page of any proposal

    private $api;
    private $param;
    private $service;

    public function __construct (API $api, ProposalStorageService $service) {
        $this->api = $api;
        $this->service = $service;
        $this->service->setDirectory (self::PROPOSALS_DIRECTORY);
    }


    /**
     * Proposal Detail
    */
    public function proposalDetail (int $advertiserId, int $page = self::DEFAULT_PAGE):object {
        $proposal = $this->findAdvertiserOffer ($advertiserId, $page);

        // check if number of offer proposed are more than number of returned offer
        if (((int) ((array) ((array) $proposal->links)['@attributes'])['total-matched']) > (count($proposal->links->link))) {
            $this->proposalDetail ($advertiserId, (int) (ceil (count ($proposal->links->link)/self::MAX_API_PAGINATION_LIMIT)) + 1);
        }
        return $proposal;
    }

    /**
     * Method to search for product offers
     */
    public function getProposals (array $advertisers, array $params) {
        $proposals = array_values (array_filter (array_map (function ($advertiser_id) {
            if ($offers = $this->findAdvertiserOffer ((int) $advertiser_id)) {
                return $this->firstProposal ($offers);
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

    /**
     * Method to return first proposals only
     */
    private function firstProposal (object $proposals) {
        $total = (int) current (current ($proposals->{key($proposals)}));
        $proposal = current (end ($proposals->{key($proposals)}));
        $proposal->totalCount = $total;
        return $proposal;
    }

    /**
     * Check if advertiser's offer cache exists or not
     */
    private function findAdvertiserOffer (int $advertiserId, int $page = self::DEFAULT_PAGE, int $limit = self::MAX_API_PAGINATION_LIMIT) {
        if ($this->service->checkAdvertiserResourceExtsts($advertiserId)) {
            $proposal = json_decode ($this->service->retrieveAdvertiserResource ($advertiserId));
            // check for required pagination
            if ($page > (int) ceil (((int) count($proposal->links->link)/$limit))) {
                // fetch and return proposals from api
                return $this->fetchAdvertiserOffer ($advertiserId, $page, $limit);
            }
            // else will return previous proposals
            return $proposal;
        } else {
            return $this->fetchAdvertiserOffer ($advertiserId, $page, $limit);
        }
    }

    /**
     * fetch advertiser offer from API and cache API response
     */
    private function fetchAdvertiserOffer (int $advertiserId, int $page, int $limit):?object {
        // fetch API response from Commission-junction
        $proposals = $this->api->proposals ($this->modifyParameters (['advertiser' => $advertiserId, 'page' => $page, 'limit' => $limit]));

        // proposals not found
        if (!$proposals)
            return null;

        $proposals = $this->simplifyProposals (json_decode (json_encode (simplexml_load_string ($proposals))));

        // proposals not found
        if (!$proposals)
            return null;

        // save offer as cache
        $this->service->saveAdvertiserResponse ($advertiserId, $proposals);
        return json_decode ($this->service->retrieveAdvertiserResource ($advertiserId));
    }

    /**
     * Check if proposal exists the convert into array 
     * else return null
     */
    private function simplifyProposals (object $commissionJunction):?object {
        // unable to identify API response
        if (!isset ($commissionJunction->links->link)) {
            return null;
        }

        $commissionJunction->links->link = is_array($commissionJunction->links->link) ? $commissionJunction->links->link : [$commissionJunction->links->link];
        return $commissionJunction;
    }

    /*******Commission Section*****************/

    /**
     * Method to fetch commission detail
     */
    public function getCommission ():object {
        return json_decode ($this->api->commission($this->generateCommissionQuery($this->api->getPublisherId())));
    }


    /********Advertiser section*********/

    /**
     * Method to fetch list of advertisers
     */
    public function getAdvertisers (array $params):object {
        return $this->simplifyAdvertisers (json_decode (json_encode (simplexml_load_string ($this->api->advertisers($this->modifyParameters($params))))));
    }

    private function simplifyAdvertisers (object $advertisers):object {
        $advertisers->advertisers->advertiser = is_array($advertisers->advertisers->advertiser) ? $advertisers->advertisers->advertiser : [$advertisers->advertisers->advertiser];
        return $advertisers;
    }
}