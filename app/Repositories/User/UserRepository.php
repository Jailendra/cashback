<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Repository implements IUserRepository {

    public function findAffilate (User $user):?User {
        return $user->referBy()->first();
    }

    public function findUserByRole (string $role):?Collection {
        return $this->model->where('role', $role)->get();
    }

    public function updateUser (int $id, array $fields):bool {
        $this->find ($id)->profile()->updateOrCreate([], $fields);
        return $this->update($id, $fields);
    }

    public function getProfile(int $id) :?User {
        $user = $this->find($id);
        $user->profile = $user->profile;
        return $user; 
        
    }

    public function updateBankDetails(int $id, array $fields) {
        return $this->find($id)->bank()->updateOrCreate([], $fields);
    }
}