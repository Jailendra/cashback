<?php

namespace App\Repositories\CommissionReceived;

use App\Repositories\Repository;

class CommissionReceivedRepository extends Repository implements ICommissionReceivedRepository {

    public function sumUserNonDisburseCommissions (int $user_id):float {
        return $this->model->where (['disburse' => false, 'user_id' => $user_id])->sum('amount');
    }

    public function saveCashbackRequest (int $user_id, string $mode):bool {
        return $this->model->where (['disburse' => false, 'user_id' => $user_id])->update(['mode' => $mode, 'request_date' => now()]);
    }

    public function paginatePendingCashback (int $limit) {
        return $this->model->where ('disburse', false)->whereNotNull('request_date')->select(['user_id', 'mode', 'request_date', \DB::raw("SUM(amount) as amount")])->groupBy(['user_id', 'mode', 'request_date'])->paginate($limit);
    }

    public function paginateUserPendingCashback (int $user_id, int $limit) {
        return $this->model->where (['disburse' => false, 'user_id' => $user_id])->whereNotNull('request_date')->orderBy('request_date', 'desc')->paginate($limit);
    }

    public function disburseCommissions (array $ids) {
        return $this->model->whereIn('id', $ids)->update([
            'disburse' => true,
            'disbursed_date' => now()
        ]);
    }

    public function paidCommissions (int $limit) {
        return $this->model->where (['disburse' => true])->orderBy('disbursed_date', 'desc')->paginate($limit);
    }
}