<?php

namespace App\Services\Commands;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\CommissionDetail\ICommissionDetailRepository as Repository;
use App\Services\Parsers\API\ICommission;

use App\Services\APIService;
use App\Services\AggregatorService;

class CommissionService {

    private $service;
    private $aggregatorService;

    public function __construct (Repository $repository, APIService $service, AggregatorService $aggregatorService) {
        $this->service = $service;
        $this->aggregatorService = $aggregatorService;
        $this->repository = $repository;
    }


    /**
     * Method to fetch commission detail of sales
     */
    public function saveCommission () {
        $commissions = $this->getCommission ();
        array_walk ($commissions, function ($record) {
            $this->saveCommissionDetail ($record);
        });
    }

    private function getCommission ():array {
        return array_reduce (array_map (function ($aggregator) {
            return $this->service->parseCommission ($aggregator['name'], $this->service->getCommission ($aggregator['name']));
        }, $this->aggregatorService->findActiveAggregators()->toArray()), 'array_merge', []);
    }

    /**
     * Insert commission detail
     */
    private function saveCommissionDetail (ICommission $record):Model {
        // save new reord if not exists
        return $this->repository->updateOrCreate([
            'order_id' =>  $record->orderId()
        ],[
            'user_id' =>  $record->userId(),
            'sale_amount_usd' =>  $record->saleAmountUSD(),
            'total_commission_usd' => $record->commissionReceived(),
            'commission_api_response' =>  $record->all(),
        ]);
    }
}