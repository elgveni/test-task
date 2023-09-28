<?php

namespace App\Services;

use App\Models\Project;

interface ProjectServiceInterface
{
    /**
     * Create a new project.
     *
     * @param array $params - The parameters for creating the project.
     *
     * @return bool|string|Project - The result of the project creation process.
     */
    public function create($params): bool|string|Project;

    /**
     * Remove a project by its ID.
     *
     * @param int $projectId - The ID of the project to be removed.
     *
     * @return void
     */
    public function remove($projectId): void;
}
