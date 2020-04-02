<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Aggregator;

use App\Repositories\Aggregator\IAggregatorRepository as Repository;

class AggregatorService {

    private $repository;

    public function __construct (Repository $repository) {
        $this->repository = $repository;
    }

    public function findActiveAggregators () {
        return $this->repository->findActiveAggregators();
    }

    public function findAggregators () {
        return $this->repository->findAggregators();
    }

    public function updateAggregator (Request $request) {
        $model = $this->repository->find($request->route()->parameter('id'));
        return $model->toggleStatus()->save();
    }
}