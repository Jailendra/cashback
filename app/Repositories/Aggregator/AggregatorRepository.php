<?php

namespace App\Repositories\Aggregator;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;

class AggregatorRepository extends Repository implements IAggregatorRepository {
    
    public function findActiveAggregators ():Collection {
        return $this->model->where('active', true)->select(['id', 'name'])->get();
    }

    public function findAggregators(): Collection{
        return $this->model->select(['id', 'name', 'active'])->get();
    }
}