<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Repository implements IRepository {

    protected $model;

    public function __construct (Model $model) {
        $this->model = $model;
    }

    public function create (array $fields):Model {
        return $this->model->create($fields);
    }
    public function delete (int $id):bool {
        return $this->model->findOrFail($id)->delete();
    }

    public function update (int $id, array $fields):bool {
        return $this->model->findOrFail ($id)->update($fields);
    }

    public function find (int $id):Model {
        return $this->model->findOrFail ($id);
    }

    public function paginate (int $limit):LengthAwarePaginator {
        return $this->model->paginate($limit);
    }

    public function get ():Collection {
        return $this->model->get();
    }

    public function updateOrCreate (array $searchBy, array $aupdateFields):Model {
        return $this->model->updateOrCreate ($searchBy, $aupdateFields);
    }

    public function count ():int {
        return $this->model->count();
    }
}