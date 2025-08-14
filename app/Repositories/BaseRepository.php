<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected array $with = [];

    public function __construct(protected Model $model)
    {
    }

    public function all()
    {
        return $this->model->with($this->with)->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data)->load($this->with);
    }

    public function find(Model $model): Model
    {
        return $model->load($this->with);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->load($this->with);
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }
}
