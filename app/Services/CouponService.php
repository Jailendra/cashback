<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Coupon\ICouponRepository as Repository;

class CouponService {

    private $repository;
    private $storageService;

    const COUPON_IMAGE_DIRECTORY = 'trademark';

    public function __construct (Repository $repository, StorageService $storageService) {
        $this->repository = $repository;
        $this->storageService = $storageService;
    }

    /**
     * Method to get active coupons
     * 
     * @param Illuminate\Http\Request
     */
    public function getActiveCoupons(Request $request) {
        return $this->repository->paginateActiveCoupons(env('PAGINATION_LIMIT', 10));
    }

    /**
     * Method to get all coupons
     */
    public function getCoupons (Request $request) {
        return $this->repository->paginate($request->input('limit', env('PAGINATION_LIMIT', 10)));
    }

    /**
     * Method to add new Coupon
     */
    public function store (Request $request) {
        return $this->repository->create(array_merge ($request->only(['brand', 'discount', 'affiliate_url', 'callback_url', 'offer_type', 'start_date', 'end_date']), ['image' => $this->storageService->saveFile ($request->image, self::COUPON_IMAGE_DIRECTORY)]));
    }

    /**
     * Methoid to update Coupon request
     */
    public function updateCoupon (Request $request) {
        $fields = $request->only(['brand', 'discount', 'affiliate_url', 'callback_url', 'offer_type', 
        'start_date', 'end_date']);

        if ($request->hasFile('image')) {
            $fields['image'] = $this->storageService->saveFile ($request->image, self::COUPON_IMAGE_DIRECTORY);
        }

        $this->repository->update((int) $request->route()->parameter('id'), $fields);
    }

    /**
     * Methoid to get Coupon
     */
    public function getCoupon(Request $request) {
        return $this->repository->find((int) $request->route()->parameter('id'));
    }

    /**
     * Methoid to delete Coupon
     */
    public function deleteCoupon(Request $request){
        return $this->repository->delete((int) $request->route()->parameter('id'));
    }
}