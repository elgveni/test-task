<?php

namespace App\Services\Redmine;

use App\Services\IssueServiceInterface;

class RedmineIssueService extends RedmineCoreService implements IssueServiceInterface
{
    /**
     * Get the API endpoint path for issues.
     *
     * @return string - The API endpoint path for issues.
     */
    protected function getPath(): string
    {
        return 'issues';
    }

    /**
     * Create a new issue in Redmine.
     *
     * @param array $params - The parameters for creating the issue.
     *
     * @return bool|string - The API response as a JSON string.
     */
    public function create($params): bool|string
    {
        $params = $this->convertParams($params);
        $issue = $this->sendRequestPost(['issue' => $params]);

        return $issue;
    }

    /**
     * Remove an issue from Redmine.
     *
     * @param int $issueId - The ID of the issue to be removed.
     *
     * @return void
     */
    public function remove($issueId): void
    {
        $this->sendRequestGet($issueId, 'DELETE');
    }

    /**
     * Convert and normalize issue creation parameters.
     *
     * @param array $params - The parameters to be normalized.
     *
     * @return array - The normalized parameters.
     */
    private function convertParams($params): array
    {
        $defaults = [
            'subject' => null,
            'description' => null,
            'project_id' => null,
            'category_id' => null,
            'priority_id' => 2,
            'status_id' => null,
            'tracker_id' => null,
            'assigned_to_id' => null,
            'author_id' => null,
            'due_date' => null,
            'start_date' => null,
            'watcher_user_ids' => null,
            'fixed_version_id' => null,
        ];

        $params = array_merge($defaults, $params);

        return $params;
    }
}
