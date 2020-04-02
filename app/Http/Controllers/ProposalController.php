<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdvertiserDetailRequest;
use Illuminate\View\Factory;

use App\Services\ProposalService as Service;

class ProposalController extends Controller
{
    private $service;
    
    public function __construct (Service $service) { 
        $this->service = $service;
    }

    public function index (Request $request) {
        return $this->service->getProposalJson ($request);
    }

    /**
     * Method to get advertiser proposal detail
     */
    public function proposalDetail (AdvertiserDetailRequest $request, Factory $view) {
        return $view->make('home.proposal_detail.index', ['detail' => $this->service->getProposalDetail ($request)]);
    }
}