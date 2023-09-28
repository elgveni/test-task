<?php

namespace App\Services;

use App\Models\Issue;

interface IssueServiceInterface
{
    /**
     * Create a new issue.
     *
     * @param array $params - The parameters for creating the issue.
     *
     * @return bool|string|Issue - The result of the issue creation process.
     */
    public function create($params): bool|string|Issue;

    /**
     * Remove an issue by its ID.
     *
     * @param int $issueId - The ID of the issue to be removed.
     *
     * @return void
     */
    public function remove($issueId): void;
}
