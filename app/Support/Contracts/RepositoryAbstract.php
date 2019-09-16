<?php

namespace App\Support\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


abstract Class RepositoryAbstract
{

    /**
     * @param $model
     * @return Collection|null
     */
    abstract public function all($model): ?Collection;


    /**
     * @param $model
     * @param array $data
     * @return Model|null
     */
    abstract public function create($model, array $data): ?Model;

    /**
     * @param $model
     * @param array $data
     * @return bool
     */
    abstract public function save($model, array $data): bool;


    /**
     * @param $model
     * @param array $data
     * @return Model|null
     */
    abstract public function update($model, array $data): ?Model;


    /**
     * @param $model
     * @param int $id
     * @return Model|null
     */
    abstract public function find($model, int $id): ?Model;


    /**
     * @param $model
     * @return bool|null
     */
    abstract public function delete($model): ?bool;

    /**
     * apply relations on models...
     *
     * @param $model
     * @param string $related
     * @param string $relation
     * @param mixed $data
     * @return mixed
     */
    abstract function applyRelation($model, string $related, string $relation, $data = null);


    /**
     * retrieve single record where conditions...
     *
     * @param $model
     * @param array $needle
     * @return Collection|null
     */
    abstract function findSingleWhere($model, array $needle): ?Model;


    /**
     * retrieve records where conditions...
     *
     * @param $model
     * @param array $needle
     * @return Collection|null
     */
    abstract function findWhere($model, array $needle): ?Collection;
}
