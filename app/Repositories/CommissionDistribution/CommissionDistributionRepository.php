<?php

namespace App\Repositories\CommissionDistribution;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;

class CommissionDistributionRepository extends Repository implements ICommissionDistributionRepository {

    public function findByBenificaryType (string $type, string $beneficiary):Collection {
        return $this->model->where ('type', $type)->where('beneficiary', $beneficiary)->get();
    }

    public function findByType (string $type):Collection {
        return $this->model->where ('type', $type)->get();
    }
}