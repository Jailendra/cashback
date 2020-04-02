<?php

namespace App\Repositories\User;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\IRepository;

interface IUserRepository extends IRepository {
    public function findAffilate (User $user):?User;
    public function findUserByRole (string $role):?Collection;
    public function updateBankDetails(int $id, array $fields);
}