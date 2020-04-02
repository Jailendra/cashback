<?php

namespace App\Services;

use App\User;
use App\Repositories\User\IUserRepository as Repository;
use Illuminate\Http\Request;

class UserService {
    
    private $repository;

    public function __construct (Repository $repository) {
        $this->repository = $repository;
    }

    public function find(int $user_id):?User {
        return $this->repository->find($user_id);
    }

    public function getProfile(Request $request):?User {
        return $request->user();
    }

    public function findAffilates (User $user, int $level):?User {
        for ($i=0; $i < $level; $i++) {
            if ($user && ($referBy = $this->repository->findAffilate ($user))) {
                $user = $referBy;
            } else {
                $user = null;
                break;
            }
        }

        return $user;
    }

    public function findUserByRole (string $role) {
        return $this->repository->findUserByRole ($role);
    }

    public function updateProfile(Request $request){
        return $this->repository->updateUser($request->user()->id, $request->only(['name', 'country', 'dob', 'mobile_number', 'currency', 'language', 'gender', 'display_name']));
    }

    public function get (Request $request) {
        return $this->repository->find((int) $request->route()->parameter('userId'));
    }

    public function updateBankDetails(Request $request){
        return $this->repository->updateBankDetails($request->user()->id, $request->only(['user_id', 'bank_name', 'branch_name', 'account_name', 'account_number', 'swift', 'iban']));
    }

    public function getBankDetails(Request $request){
        return $request->user()->bank()->first();
    }

    public function getUsers(Request $request) {
        return $this->repository->paginate($request->input('limit', env('PAGINATION_LIMIT', 10)));
    }

    public function updatePassword(Request $request){
        return $this->repository->update($request->user()->id, ['password'=>app('hash')->make($request->new_password)]);
    }
}