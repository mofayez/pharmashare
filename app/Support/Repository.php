<?php

namespace App\Support;


use App\Support\Contracts\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Repository extends RepositoryAbstract
{

    /**
     * @param $model
     * @return Collection|null
     */
    public function all($model): ?Collection
    {
        return $model->all();
    }

    /**
     * @param $model
     * @param array $data
     * @return Model|null
     */
    public function create($model, array $data): ?Model
    {
        return $model->create($data);
    }


    /**
     * @param $model
     * @param array $data
     * @return bool
     */
    public function save($model, array $data): bool
    {
        foreach ($data as $key => $item) {

            $model->$key = $item;
        }

        return $model->save();
    }

    /**
     * @param $model
     * @param array $data
     * @return Model|null
     */
    public function update($model, array $data): ?Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @param $model
     * @param int $id
     * @return Model|null
     */
    public function find($model, int $id): ?Model
    {
        return $model->find($id);
    }

    /**
     * @param $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete($model): ?bool
    {
        try {

            return $model->delete();

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }


    /**
     * apply relations between models
     *
     * @param $model
     * @param string $related
     * @param string $relation
     * @param null $data
     * @return mixed
     */
    public function applyRelation($model, string $related, string $relation, $data = null)
    {
        return $model->$related()->$relation($data);
    }


    /**
     * retrieve single records where conditions...
     *
     * @param $model
     * @param array $needle
     * @return Model|null
     */
    public function findSingleWhere($model, array $needle): ?Model
    {

        return call_user_func_array([$model, 'where'], $needle)->first();
    }


    /**
     * retrieve records where conditions...
     *
     * @param $model
     * @param array $needle
     * @return Model|null
     */
    public function findWhere($model, array $needle): ?Collection
    {

        return call_user_func_array([$model, 'where'], $needle)->get();
    }

}