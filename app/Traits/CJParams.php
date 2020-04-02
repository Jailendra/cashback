<?php

namespace App\Traits;

trait CJParams {
    
    private function searchParams ():array {
        return ['limit' => 'records-per-page', 'page' => 'page-number', 'category'=>'category', 'search' => 'keywords', 'advertiser' => 'advertiser-ids'];
    }

    public function modifyParameters(array $params):array {
        return array_reduce (
            array_filter (
                array_map (
                    function ($key, $value) use ($params) {
                        return array_key_exists($key, $params) ? [$value => $params[$key]] : null;
                    }, array_keys($this->searchParams()), $this->searchParams()
                )
            ), 'array_merge', []);
    }

    public function generateCommissionQuery (int $publisher_id):string {
        return "{publisherCommissions(forPublishers: [\"{$publisher_id}\"], sincePostingDate:\"{$this->getUTCDate ('-1 days')}\",beforePostingDate:\"{$this->getUTCDate ()}\"),{  count  payloadComplete  records { actionStatus aid clickDate clickReferringURL coupon orderId saleAmountPubCurrency saleAmountUsd shopperId sid items { totalCommissionUsd }}}}";
    }

    private function getUTCDate (string $diff = null):string {
        return (new \DateTime($diff))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z');
    }

    public function listParams (array $params):object {
        return (object) [
            'page' => $params['page'] ?? self::DEFAULT_PAGE,
            'limit' => $params['limit'] ?? env('PAGINATION_LIMIT', 10),
            'category' => $params['category'] ?? null
        ];
    }
}