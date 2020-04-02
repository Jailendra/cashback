<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Http\Requests\CashbackRequest;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\ProcessCashback;
use App\Services\CommissionReceivedService as Service;

class CommissionController extends Controller {

    protected $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @route admin/commission reports
     * @method GET
     * @param  \App\Models\admin\CommissonReport  $commissionreport
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request, Factory $view) {
        return $view->make('admin.commission.index', ['list' => $this->service->paginate($request)]);
    }

    /**
     * Method to display the sum of user's cashback pending
     * 
     * @route   /user-cashback
     * @method GET
     * 
     * @roles Admin,User
     */
    public function getUserCashback (Request $request, Factory $view) {
        return $view->make('cashback.cashback-overview', ['cashback' => $this->service->getUserCommissions($request)]);
    }

    /**
     * Method to receive user's cashback request
     * 
     * @route /cashback
     * 
     * @method PUT
     * 
     * @roles Admin,User
     */
    public function requestCashback (CashbackRequest $request, Redirector $redirector) {
        $this->service->requestCashback ($request);
        return $redirector->to('/cashback')->with('message', 'Cashback request has been send to admin.');
    }

    /**
     * Method to list all cashback-request to admin 
     * 
     * @route admin/commissions/request-cashback
     * @method GET
     */
    public function pendingCashbackList (Request $request, Factory $view) {
        return $view->make('admin.commission.pending-cashback', ['list' => $this->service->pendingCashbackList ($request)]);
    }

    public function pendingUserCashbackDetail (GetUserRequest $request, Factory $view) {
        return $view->make('admin.commission.pending-cashback-user-detail', ['list' => $this->service->pendingUserCashbackDetail($request)]);
    }

    public function processCashback (ProcessCashback $request, Redirector $redirector) {
        $this->service->processCashback ($request);
        return $redirector->to('/admin/commissions/request-cashback')->with('message', 'Payment successfully processed.');
    }

    /**
     * @route admin/commissions/request-cashback/processed
     * @method GET
     */
    public  function processedCashback (Request $request, Factory $view) {
        return $view->make('admin.commission.processed-cashback', ['list' => $this->service->processedCashback($request)]);
    }
}
