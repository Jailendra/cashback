<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use App\Services\CommissionDistributionService as Service;

class CommissionDistributionController extends Controller
{   

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service) {
        $this->service = $service;        
    }

    public function index (Request $request, Factory $view) {
        return $view->make('admin.affiliate.index', ['affiliates'=>$this->service->all()]);       
    }
}
