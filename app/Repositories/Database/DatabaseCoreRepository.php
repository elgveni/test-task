<?php
namespace App\Repositories\Database;

use Illuminate\Database\Eloquent\Model;

abstract class DatabaseCoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass(): mixed;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Model|mixed
     */
    protected function startConditions(): mixed
    {
        return clone $this->model;
    }
}
