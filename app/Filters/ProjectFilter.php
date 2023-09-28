<?php

namespace App\Filters;

class ProjectFilter extends CoreFilter
{
    /**
     * Apply a search filter to the query builder.
     *
     * This method adds a search filter to the query builder if a search value is provided.
     *
     * @param string|null $value - The search value to filter by.
     */
    public function search($value): void
    {
        if ($value) {
            $this->builder->whereRaw('LOWER(name) LIKE ?', ["%{$value}%"]);
        }
    }

    /**
     * Apply a version filter to the query builder.
     *
     * This method adds a version filter to the query builder if a version value is provided.
     *
     * @param int|null $value - The version ID to filter by.
     */
    public function version($value): void
    {
        if ($value) {
            $this->builder->where('default_version_id', $value);
        }
    }

    /**
     * Apply a date filter to the query builder.
     *
     * This method adds a date filter to the query builder if a date value is provided.
     *
     * @param string|null $value - The date value to filter by.
     */
    public function date($value): void
    {
        if ($value) {
            $this->builder->whereDate('created_at', $value);
        }
    }

    /**
     * Apply a public filter to the query builder.
     *
     * This method adds a public filter to the query builder based on a provided value.
     *
     * @param mixed $value - The public value to filter by.
     */
    public function public($value): void
    {
        if ($value != "") {
            $this->builder->where('is_public', $value);
        }
    }

    /**
     * Apply an identifier filter to the query builder.
     *
     * This method adds an identifier filter to the query builder if an identifier value is provided.
     *
     * @param string|null $value - The identifier value to filter by.
     */
    public function identifier($value): void
    {
        if ($value) {
            $this->builder->whereRaw('LOWER(identifier) LIKE ?', ["%{$value}%"]);
        }
    }
}
