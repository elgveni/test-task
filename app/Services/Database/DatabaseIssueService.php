<?php

namespace App\Services\Database;

use App\Models\Issue;
use App\Services\IssueServiceInterface;

class DatabaseIssueService implements IssueServiceInterface
{
    /**
     * Create a new issue.
     *
     * @param array $params - The parameters for creating the issue.
     *
     * @return Issue - The created issue instance.
     */
    public function create($params): Issue
    {
        $issue = Issue::create($params);

        return $issue;
    }

    /**
     * Remove an issue by its ID.
     *
     * @param int $issueId - The ID of the issue to be removed.
     *
     * @return void
     */
    public function remove($issueId): void
    {
        Issue::find($issueId)->delete();
    }
}
