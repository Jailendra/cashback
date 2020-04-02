<?php

namespace App\Repositories\CommissionDistribution;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\IRepository;

interface ICommissionDistributionRepository extends IRepository {
    public function findByBenificaryType (string $type, string $beneficiary):Collection;
    public function findByType (string $type):Collection;
}