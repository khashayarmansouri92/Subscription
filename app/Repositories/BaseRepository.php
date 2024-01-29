<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $attributes
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $attributes): Model
    {
        return $this->model::firstOrCreate($attributes);
    }


    /**
     * @param array $arr
     * @return object|null
     */
    public function findByKeyValues(array $arr): object|null
    {
        return $this->model->where(function ($query) use ($arr) {
            foreach ($arr as $key => $value) {
                $query->where($key, $value);
            }
        })->get();
    }

    /**
     * @param array $arr
     * @return object|null
     */
    public function findByKeyValue(array $arr): object|null
    {
        return $this->model->where(function ($query) use ($arr) {
            foreach ($arr as $key => $value) {
                $query->where($key, $value);
            }
        })->first();
    }

    /**
     * @param $id
     * @param array $relationships
     * @return mixed
     */
    public function findById($id, array $relationships = []): mixed
    {
        return $this->model->with($relationships)->find($id);
    }

    /**
     * @param array $relationships
     * @return Builder|Model
     */
    public function firstOrFail(array $relationships = []): Model|Builder
    {
        return $this->model->where($relationships)->firstOrFail();
    }

    /**
     * @param array $conditions
     * @return Builder
     */
    public function getElementsByCondition(array $conditions = []): Builder
    {
        if (!empty($conditions['conditional'])) {
            $this->model->where(function ($query) use ($conditions) {
                foreach ($conditions['conditional'] as $condition) {
                    $query->orWhere($condition);
                }
            });
        }

        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed
    {
        return $this->model->get();
    }

    /**
     * @param Model $entity
     * @param array $attributes
     * @return bool
     */
    public function update(Model $entity, array $attributes): bool
    {
        return $entity->update($attributes);
    }

}
