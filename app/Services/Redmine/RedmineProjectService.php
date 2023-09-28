<?php

namespace App\Services\Redmine;

use App\Services\ProjectServiceInterface;

class RedmineProjectService extends RedmineCoreService implements ProjectServiceInterface
{
    /**
     * Get the API endpoint path for projects.
     *
     * @return string - The API endpoint path for projects.
     */
    protected function getPath(): string
    {
        return 'projects';
    }

    /**
     * Create a new project in Redmine.
     *
     * @param array $params - The parameters for creating the project.
     *
     * @return bool|string - The API response as a JSON string.
     */
    public function create($params): bool|string
    {
        $params = $this->convertParams($params);
        $issue = $this->sendRequestPost(['project' => $params]);

        return $issue;
    }

    /**
     * Remove a project from Redmine.
     *
     * @param int $projectId - The ID of the project to be removed.
     *
     * @return void
     */
    public function remove($projectId): void
    {
        $this->sendRequestGet($projectId, 'DELETE');
    }

    /**
     * Convert and normalize project creation parameters.
     *
     * @param array $params - The parameters to be normalized.
     *
     * @return array - The normalized parameters.
     */
    private function convertParams($params): array
    {
        $params['identifier'] = strtolower(str_replace(' ', '_', $params['name']));

        $defaults = [
            'name' => null,
            'identifier' => null,
            'description' => null,
        ];

        $params = array_merge($defaults, $params);

        return $params;
    }
}
