<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    /**
     * Get category options, potentially filtered by a project identifier.
     *
     * @param string|null $projectIdentify - The identifier of the project for which to fetch category options.
     *
     * @return mixed - An array of category options.
     */
    public function getCategoryOptions($projectIdentify = null): mixed;
}
