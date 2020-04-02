<?php

namespace App\Services\Jobs;

use App\User;
use App\Services\UserService;
use App\Models\CommissionDistribution;
use App\Services\CommissionDistributionService as Service;
use  App\Repositories\CommissionReceived\ICommissionReceivedRepository as Repository;

class CommissionReceivedService {

    const PERCENTAGE_TO_NUMERIC = 100;
    const ROLE_ADMIN = 'admin';

    private $service;
    private $repository;
    private $userService;

    public function __construct (Repository $repository, Service $service, UserService $userService) {
        $this->service = $service;
        $this->repository = $repository;
        $this->userService = $userService;
    }

    public function initialize (User $user = null, float $amount, int $commission_id, string $type) {
        // set user as admin and add all commission into admin account
        if (!$user) {
            $user = $this->findAdmin();
        }

        $this->saveCommissions ($user, $amount, $commission_id, $type);
    }

    private function saveCommissions (User $user, float $amount, int $commission_id, string $type) {
        $this->service->findByType($type)->each (function ($commission_distribution) use ($user, $amount, $commission_id) {
            $this->saveCommissionByType ($user, $amount, $commission_id, $commission_distribution);
        });
    }

    private function saveCommissionByType (User $user, float $amount, int $commission_id, CommissionDistribution $commission_distribution) {
        switch (strtoupper ($commission_distribution->beneficiary)) {
            case 'SELF':
                // save customer's commission
                return $this->saveCommissionReceived ($user->id, $this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
            case 'AFFILATES':
                // save affilates commission
                return $this->saveAffilatesCommission ($user, $amount, $commission_id, $commission_distribution);
            case 'ADMIN':
                // save admin commission
                return $this->saveAdminCommission ($this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
            case 'COMPANY':
                // save company commission
                return $this->saveCompanyCommission ($amount, $commission_id, $commission_distribution);
        }
    }

    private function calculateCommission (float $amount, float $commission):float {
        return $amount * ($commission/self::PERCENTAGE_TO_NUMERIC);
    }

    private function saveCompanyCommission (float $amount, int $commission_id, CommissionDistribution $commission_distribution) {
        // find company role
        $company = $this->userService->findUserByRole ($commission_distribution->beneficiary)->first();

        // check if company exists
        if (!$company) {
            // save commission into admin account is company does not exists
            return $this->saveAdminCommission ($this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
        }

        // save commission into company account
        return $this->saveCommissionReceived ($company->id, $this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
    }

    /**
     * Method to save commission beliongs to Admin
     */
    private function saveAdminCommission (float $amount, int $commission_id, string $commission_type) {
        return $this->saveCommissionReceived ($this->findAdmin()->id, $amount, $commission_id, $commission_type);
    }

    /**
     * Find Admin user
     */
    private function findAdmin():User {
        return $this->userService->findUserByRole (self::ROLE_ADMIN)->first();
    }

    /**
     * Method to Save Affilates commission
     * If affilates does not exists, then save commission into admin account
     */
    private function saveAffilatesCommission (User $user, float $amount, int $commission_id, CommissionDistribution $commission_distribution) {
        $affilates = $this->userService->findAffilates ($user, $commission_distribution->level);
        if (!$affilates) {
            // save commission into admin account
            return $this->saveAdminCommission ($this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
        }

        return $this->saveCommissionReceived ($affilates->id, $this->calculateCommission ($amount, $commission_distribution->commission), $commission_id, $commission_distribution->type);
    }

    /**
     * Method to save user commission into respective DB-Table
     */
    private function saveCommissionReceived (int $user_id, float $amount, int $commission_id, string $commission_type) {
        return $this->repository->create([
            'user_id' => $user_id,
            'amount' => $amount,
            'commission_type' => $commission_type,
            'commission_id' => $commission_id
        ]);
    }
}