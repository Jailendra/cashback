<?php

namespace App\Repositories\Advertiser;

use Illuminate\Http\Request;
use App\Repositories\IRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface IAdvertiserRepository extends IRepository {
    public function getAdvertisers(int $limit) : LengthAwarePaginator;
    public function restore(int $id);
    public function getActiveCategories ();
    public function getAdvertiserById (int $advertiserId);
    public function paginateActiveAggregatorAdvertisor (int $limit, string $category = null);
}