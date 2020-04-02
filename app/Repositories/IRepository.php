<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IRepository {
    public function create (array $fields):Model;
    public function delete (int $id):bool;
    public function update (int $id, array $fields):bool;
    public function find (int $id):Model;
    public function paginate (int $limit):LengthAwarePaginator;
    public function get ():Collection;
    public function updateOrCreate (array $searchBy, array $aupdateFields):Model;
    public function count ():int;
}