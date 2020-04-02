<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\AdvertiserPutRequest;
use App\Http\Requests\Admin\AdvertiserGetRequest;
use App\Services\AdvertiserService as Service;

class AdvertiserController extends Controller {

    protected $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @route admin/advertisers
     * @method GET
     * @param  \App\Models\admin\Advirtiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request, Factory $view) {
        return $view->make('admin.advertiser.index', ['advertisers' => $this->service->getAdvertisers($request)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Advirtiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertiserPutRequest $request, Redirector $redirector) {
        $this->service->updateAdvertiser ($request);
        return $redirector->to('/admin/advertisers/'.$request->route()->parameter('id'))->with('message', 'Advertiser successfully updated');
    }

    /**
     * view the specified resource in storage.
     * 
     * @route admin/advertisers
     * @method  GET
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Advirtiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function view (AdvertiserGetRequest $request, Factory $view) {
        return $view->make('admin.advertiser.store', ['advertiser' => $this->service->getAdvertiser($request)]);
    }

    /**
     * API method to fetch categories
     */
    public function getCategories (Request $request) {
        return $this->service->getAllCategories ();
    }
}
