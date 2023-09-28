<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\ListProjectRequest;
use App\Repositories\ProjectRepositoryInterface;
use App\Services\ProjectServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    private $projectRepository;
    private $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
        $this->projectRepository = app(ProjectRepositoryInterface::class);

    }

    /**
     * List projects based on the given request parameters.
     *
     * @param ListProjectRequest $request - The request containing filter parameters.
     * @return LengthAwarePaginator - Paginator containing a list of projects.
     */
    public function list(ListProjectRequest $request): LengthAwarePaginator
    {
        $projects = $this->projectRepository->getProjects($request);
        return $projects;
    }

    /**
     * Display the form for creating a new project.
     *
     * @return Factory|Application|View|View - The view for creating a new project.
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     *
     * @param CreateProjectRequest $request - The request containing project data.
     * @return JsonResponse - JSON response indicating the success of the operation.
     */
    public function add(CreateProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create($request->all());

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    /**
     * Get options for projects.
     *
     * @return JsonResponse - JSON response containing project options.
     */
    public function getOptions(): JsonResponse
    {
        $options = $this->projectRepository->getProjectsOptions();

        return response()->json($options);
    }

    /**
     * Remove a project based on its ID.
     *
     * @param int $projectId - The ID of the project to remove.
     * @return JsonResponse - JSON response indicating the success of the removal.
     */
    public function remove($projectId): JsonResponse
    {
        $this->projectService->remove($projectId);

        return response()->json(['success' => true]);
    }
}
