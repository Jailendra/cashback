<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Advertiser\IAdvertiserRepository as Repository;
class AdvertiserService {

    private $repository;
    private $storageService;

    const ADVERTISER_IMAGE_DIRECTORY = 'advertiser-logo';

    public function __construct (Repository $repository,  StorageService $storageService) {
        $this->repository = $repository;
        $this->storageService = $storageService;
    }

    /**
     * Method to get active advertisers
     * 
     * @param Illuminate\Http\Request
     */
    public function getAdvertisers(Request $request){
        return $this->repository->getAdvertisers($request->input('limit', env('PAGINATION_LIMIT', 10)));
    }

    /**
     * Method to get active advertiser
     * 
     * @param Illuminate\Http\Request
     */
    public function getAdvertiser(Request $request){
        return $this->repository->find((int) $request->route()->parameter('id'));
    }

    /**
     * Method to add new Coupon
     */
    public function store (Request $request) {
        return $this->repository->create(array_merge ($request->only(['advertiser_id', 'advertiser_name']), ['image' => $this->storageService->saveFile ($request->image, self::ADVERTISER_IMAGE_DIRECTORY)]));
    }
    
    /**
     * Method to delete the advertiser
     */
    public function deleteAdvertiser(Request $request){
        return $this->repository->delete((int) $request->route()->parameter('id'));
    }

    /**
     * Method to restore the advertiser
     */
    public function restoreAdvertiser(Request $request){
        return $this->repository->restore((int) $request->route()->parameter('id'));
    }

    /**
     * Method to update Advertiser request
     */
    public function updateAdvertiser (Request $request) {
        $fields = $request->only(['advertiser_name']);

        if ($request->hasFile('image')) {
            $custom_data['image'] = $this->storageService->saveFile ($request->image, self::ADVERTISER_IMAGE_DIRECTORY);
            $advertiser = $this->repository->find( (int) $request->route()->parameter('id'));
            //save image data
            $this->repository->find( (int) $request->route()->parameter('id'))->custom()->updateOrCreate([], $custom_data);
        }
        return $this->repository->update((int) $request->route()->parameter('id'), $fields);
    }

    public function getAllCategories () {
        $categories = array_values (array_unique (array_filter (array_reduce ($this->repository->getActiveCategories ()->toArray(), 'array_merge', []))));
        sort ($categories);
        return $categories;
    }

    public function getAdvertiserById(int $advertiserId){
        return $this->repository->getAdvertiserById($advertiserId);
    }

    public function getActiveAggregatorAdvertisor (int $limit, string $category = null) {
        return $this->repository->paginateActiveAggregatorAdvertisor($limit, $category);
    }
}