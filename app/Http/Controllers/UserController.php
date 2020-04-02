<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Services\UserService as Service;
use App\Http\Requests\UserBankPutRequest;
use App\Http\Requests\UserChangePasswordPutRequest;


class UserController extends Controller {

    protected $service;

    public function __construct(Service $service){
        $this->service = $service;
    }

    public function index (Request $request, Factory $view) {
        //dd($this->service->getProfile ($request));
        return $view->make('user.index', ["user" => $this->service->getProfile ($request)]);
    }

    public function update (Request $request, Redirector $redirector) {
        $this->service->updateProfile($request);
        return $redirector->to('/profile-settings')->with('message', 'Profile successfully updated');
    }

    public function getUser (Request $request, Factory $view) {
        //echo "He"; die;
        return $view->make('admin.user.get', ["user" => $this->service->get ($request)]);
    }

    public function createBankDetails (Request $request, Factory $view) {
        return $view->make('user.bank-details', ["bank" => $this->service->getBankDetails ($request)]);
    }

    public function updateBankDetails(UserBankPutRequest $request, Redirector $redirector){
        $this->service->updateBankDetails($request);
        return $redirector->back()->with('message', 'Bank details updated successfully!');
    }

    public function getUsers (Request $request, Factory $view) {
        
        return $view->make('admin.user.index', ["users" => $this->service->getUsers ($request)]);
    }

    public function showChangePassword(Request $request, Factory $view){
        return $view->make('auth.change-password');
    }

    public function updateChangePassword(UserChangePasswordPutRequest $request, Redirector $redirector){
        $this->service->updatePassword($request);
        return $redirector->to('/login')->with(auth()->logout())->with('message', 'Password successfully changed. You can login now !');
    }
}
