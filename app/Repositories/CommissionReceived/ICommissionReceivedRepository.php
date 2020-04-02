<?php

namespace App\Repositories\CommissionReceived;

use App\Repositories\IRepository;

interface ICommissionReceivedRepository extends IRepository {
    public function sumUserNonDisburseCommissions (int $user_id):float;
    public function saveCashbackRequest (int $user_id, string $mode):bool;
    public function paginatePendingCashback (int $limit);
    public function paginateUserPendingCashback (int $user_id, int $limit);
    public function disburseCommissions (array $ids);
    public function paidCommissions (int $limit);
}