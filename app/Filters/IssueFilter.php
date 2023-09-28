<?php

namespace App\Filters;

class IssueFilter extends CoreFilter
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
            $this->builder->whereRaw('LOWER(subject) LIKE ?', ["%{$value}%"]);
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
            $this->builder->where('fixed_version_id', $value);
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
     * Apply a project filter to the query builder.
     *
     * This method adds a project filter to the query builder if a project ID is provided.
     *
     * @param int|null $value - The project ID to filter by.
     */
    public function project($value): void
    {
        if ($value) {
            $this->builder->where('project_id', $value);
        }
    }

    /**
     * Apply a tracker filter to the query builder.
     *
     * This method adds a tracker filter to the query builder if a tracker ID is provided.
     *
     * @param int|null $value - The tracker ID to filter by.
     */
    public function tracker($value): void
    {
        if ($value) {
            $this->builder->where('tracker_id', $value);
        }
    }

    /**
     * Apply a status filter to the query builder.
     *
     * This method adds a status filter to the query builder if a status ID is provided.
     *
     * @param int|null $value - The status ID to filter by.
     */
    public function status($value): void
    {
        if ($value) {
            $this->builder->where('status_id', $value);
        }
    }

    /**
     * Apply a category filter to the query builder.
     *
     * This method adds a category filter to the query builder if a category ID is provided.
     *
     * @param int|null $value - The category ID to filter by.
     */
    public function category($value): void
    {
        if ($value) {
            $this->builder->where('category_id', $value);
        }
    }
}
