<?php

namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryInterface {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function all() {
        return $this->model->all();
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function insert(array $data) {
        return $this->model->insert($data);
    }

    public function findMultiple($field, array $conditions) {
        return $this->model->whereIn($field, $conditions);
    }

    public function update($id, array $data) {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id) {
        $model = $this->model->find($id);
        $model->delete();
    }
}