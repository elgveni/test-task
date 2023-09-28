<?php

namespace App\Services\Database;

use App\Models\Project;
use App\Services\ProjectServiceInterface;

class DatabaseProjectService implements ProjectServiceInterface
{
    /**
     * Create a new project.
     *
     * @param array $params - The parameters for creating the project.
     *
     * @return Project - The created project instance.
     */
    public function create($params): Project
    {
        $params = $this->convertParams($params);
        $project = Project::create($params);

        return $project;
    }

    /**
     * Remove a project by its ID.
     *
     * @param int $projectId - The ID of the project to be removed.
     *
     * @return void
     */
    public function remove($projectId): void
    {
        Project::find($projectId)->delete();
    }

    /**
     * Convert project parameters, including generating the identifier.
     *
     * @param array $params - The project parameters.
     *
     * @return array - The modified project parameters.
     */
    private function convertParams($params) {
        $params['identifier'] = strtolower(str_replace(' ', '_', $params['name']));
        return $params;
    }

}
