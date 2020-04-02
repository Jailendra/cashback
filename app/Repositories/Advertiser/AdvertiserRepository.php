<?php

namespace App\Repositories\Advertiser;

use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

class AdvertiserRepository extends Repository implements IAdvertiserRepository {

    public function getAdvertisers(int $limit) : LengthAwarePaginator {
        return $this->model->withTrashed()->paginate($limit);
    }

    public function restore(int $id) {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function getActiveCategories () {
        return $this->model->where ('status', true)->pluck('categories');
    }

    public function getAdvertiserById (int $advertiserId) {
        return $this->model->where('advertiser_id', $advertiserId)->first();
    }

    public function paginateActiveAggregatorAdvertisor (int $limit, string $category = null){
        $advertisers = $this->model->whereHas('aggregator', function ($aggregator) {
            $aggregator->where('active', true);
        })->with(['aggregator' => function ($aggregator) {
            $aggregator->select(['name', 'id']);
        }])->select(['advertiser_id', 'advertiser_name', 'aggregator_id', 'image', 'id', 'commission']);

        if ($category) {
            $advertisers->whereRaw ('json_contains(categories, \'["' . $category . '"]\')');
        }
        
        return $advertisers->paginate($limit);
    }
}