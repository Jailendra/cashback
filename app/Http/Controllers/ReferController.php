<?php

namespace App\Http\Controllers;

use Illuminate\View\Factory;
use App\Http\Requests\ReferPostRequest;
use Illuminate\Routing\Redirector;
use App\Services\ReferService as Service;

class ReferController extends Controller {

    private $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    public function index (Factory $view) {
        return $view->make('refer.index');
    }

    public function sendReferRequest (ReferPostRequest $request, Redirector $redirector) {
        $this->service->sendReferRequest ($request);
        
        return $redirector->to('/refer')->with('message', 'We have send Email to your friend. waiting for his approval');
    }
}
