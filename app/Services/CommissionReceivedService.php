<?php

namespace App\Services;

use Illuminate\Http\Request;

use  App\Repositories\CommissionReceived\ICommissionReceivedRepository as Repository;

class CommissionReceivedService {
    
    private $repository;

    public function __construct (Repository $repository) {
        $this->repository = $repository;
    }
    
    public function getUserCommissions (Request $request) {
        return $this->repository->sumUserNonDisburseCommissions ($request->user()->id);
    }

    public function paginate (Request $request){
        return $this->repository->paginate ($request->input ('limit', env('PAGINATION_LIMIT', 10)));
    }

    public function requestCashback (Request $request) {
        return $this->repository->saveCashbackRequest ($request->user()->id, $request->mode);
    }

    public function pendingCashbackList (Request $request) {
        return $this->repository->paginatePendingCashback ($request->input ('limit', env('PAGINATION_LIMIT', 10)));
    }

    public function pendingUserCashbackDetail (Request $request) {
        return $this->repository->paginateUserPendingCashback ((int) $request->route()->parameter('userId'), $request->input ('limit', env('PAGINATION_LIMIT', 10)));
    }

    public function processCashback (Request $request) {
        return $this->repository->disburseCommissions (explode (',', $request->ids));
    }

    public function processedCashback (Request $request) {
        return $this->repository->paidCommissions ($request->input ('limit', env('PAGINATION_LIMIT', 10)));
    }
}