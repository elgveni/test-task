<?php

namespace App\Repositories;

use App\Http\Requests\Project\ListProjectRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    /**
     * Get a paginated list of projects based on the provided request.
     *
     * @param ListProjectRequest $request - The request object containing filtering parameters.
     *
     * @return LengthAwarePaginator - A paginated list of projects.
     */
    public function getProjects(ListProjectRequest $request): LengthAwarePaginator;

    /**
     * Get a paginated list of projects based on the provided request.
     *
     * @param ListProjectRequest $request - The request object containing filtering parameters.
     *
     * @return LengthAwarePaginator - A paginated list of projects.
     */
    public function getProjectsOptions(): mixed;
}
