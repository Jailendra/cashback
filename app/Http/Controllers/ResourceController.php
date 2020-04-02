<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StorageService as Service;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResourceController extends Controller {

    private $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    public function getResource (Request $request, ResponseFactory $response) {
        $path = $this->service->retrieveResourcePath ($request);
        $resource = $this->service->retrieveResource ($path);
        $contentType = $this->service->retrieveContentType ($path);
        return $response->make($resource, 200, ['Content-Type' => $contentType, 'Content-Disposition' => 'inline;']);
    }
}
