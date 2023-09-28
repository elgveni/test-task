<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class CoreFilter
{
    protected $builder;

    /**
     * @var Request
     */
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    /**
     * Apply filters to the query builder.
     *
     * This method iterates through the filters defined in the request and
     * applies them to the query builder using corresponding filter methods.
     *
     * @return mixed
     */
    public function apply()
    {
        foreach ($this->filters() as $filter => $value) {

            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * Get all filters from the request.
     *
     * This method retrieves all filters from the HTTP request.
     *
     * @return array
     */
    protected function filters()
    {
        return $this->request->all();
    }
}
