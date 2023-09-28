<?php

namespace App\Repositories;

use App\Http\Requests\Issue\ListIssueRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface IssueRepositoryInterface
{
    /**
     * Get a paginated list of issues based on the provided request.
     *
     * @param ListIssueRequest $request - The request object containing filtering parameters.
     *
     * @return LengthAwarePaginator - A paginated list of issues.
     */
    public function getIssues(ListIssueRequest $request): LengthAwarePaginator;

    /**
     * Get options for issues.
     *
     * @return mixed - An array of issue options.
     */
    public function getIssuesOptions(): mixed;
}
