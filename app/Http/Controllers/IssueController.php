<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\CreateIssueRequest;
use App\Http\Requests\Issue\ListIssueRequest;
use App\Repositories\IssueRepositoryInterface;
use App\Services\IssueServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class IssueController extends BaseController
{
    private $issueRepository;
    private $issueService;

    public function __construct(IssueServiceInterface $issueService)
    {
        $this->issueService = $issueService;
        $this->issueRepository = app(IssueRepositoryInterface::class);
    }

    /**
     * List issues based on the given request parameters.
     *
     * @param ListIssueRequest $request - The request containing filter parameters.
     * @return mixed - List of issues.
     */
    public function list(ListIssueRequest $request)
    {
        $issues = $this->issueRepository->getIssuesT($request);
        return $issues;
    }

    /**
     * Display the form for creating a new issue.
     *
     * @return Factory|Application|View|View - The view for creating a new issue.
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('issues.create');
    }

    /**
     * Store a newly created issue in storage.
     *
     * @param CreateIssueRequest $request - The request containing issue data.
     * @return JsonResponse - JSON response indicating the success of the operation.
     */
    public function add(CreateIssueRequest $request): JsonResponse
    {
        $issue = $this->issueService->create($request->all());

        return response()->json([
            'message' => 'Issue created successfully',
            'issue' => $issue
        ]);
    }

    /**
     * Get options for issues.
     *
     * @return JsonResponse - JSON response containing issue options.
     */
    public function getOptions(): JsonResponse
    {
        $issues = $this->issueRepository->getIssuesOptions();

        return response()->json($issues);
    }

    /**
     * Remove an issue based on its ID.
     *
     * @param int $issueId - The ID of the issue to remove.
     * @return JsonResponse - JSON response indicating the success of the removal.
     */
    public function remove($issueId): JsonResponse
    {
        $this->issueService->remove($issueId);

        return response()->json(['success' => true]);
    }
}
