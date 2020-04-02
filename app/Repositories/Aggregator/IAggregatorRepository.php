<?php

namespace App\Repositories\Aggregator;

use App\Repositories\IRepository;

use Illuminate\Database\Eloquent\Collection;

interface IAggregatorRepository extends IRepository {
    public function findActiveAggregators ():Collection;

    public function findAggregators(): Collection;
}