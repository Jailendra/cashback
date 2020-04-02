<?php

namespace App\Services;

use App\Repositories\CommissionDistribution\ICommissionDistributionRepository as Repository;

class CommissionDistributionService {

    private $repository;

    public function __construct (Repository $repository) {
        $this->repository = $repository;
    }

    public function all () {
        return $this->repository->get();
    }

    public function findByBenificaryType (string $type, string $beneficiary) {
        return $this->repository->findByBenificaryType ($type, $beneficiary);
    }

    public function findByType (string $type) {
        return $this->repository->findByType ($type);
    }
}