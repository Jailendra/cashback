<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Services\AggregatorService as Service;

class AggregatorController extends Controller {

    protected $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @route admin/aggregator
     * @method GET
     * @param  \App\Models\admin\Aggregator  $aggregators
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request, Factory $view) {
        return $view->make('admin.aggregator.index', ['aggregators' => $this->service->findAggregators($request)]);
    }

    /**
     * Updating the resource.
     *
     * @route admin/aggregator
     * @method PATCH
     * @param  \App\Models\admin\Aggregator  $aggregators
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Factory $view, Redirector $redirector) {
        $this->service->updateAggregator ($request);
        return $redirector->route('admin.aggregator');
    }

}
