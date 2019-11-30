<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class GeneralRepository
{
    protected $model;

    /**
     * GeneralRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getFillables()
    {
        return $this->model->getFillable();
    }

    /**
     * @param array $relations
     * @param       $id
     *
     * @return array
     */
    public function getByRelationsId(array $relations, $id)
    {
        $data = $this->model->with($relations)->where('id', $id)->first();
        return $data;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function get($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param Model $model
     *
     * @return boolean
     */
    public function store(Model $model)
    {
        $this->model = $model;
        return $this->model->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return array
     */
    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * @param $name
     * @param $col_name
     *
     * @return array
     */
    public function getSearch($name, $col_name)
    {
        $data = $this->model->where($col_name, 'like', "%" . $name . "%")->get();
        return $data;
    }

}