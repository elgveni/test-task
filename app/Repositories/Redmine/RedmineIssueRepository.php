<?php
namespace App\Repositories\Redmine;

use App\Http\Requests\Issue\ListIssueRequest;
use App\Repositories\IssueRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class RedmineIssueRepository extends RedmineCoreRepository implements IssueRepositoryInterface
{
    /**
     * Get the Redmine API path for issues.
     *
     * @return string - The Redmine API path for issues.
     */
    protected function getPath(): string
    {
        return 'issues';
    }

    /**
     * Get a paginated list of issues based on the provided request.
     *
     * @param ListIssueRequest $request - The request with filters and pagination parameters.
     * @return LengthAwarePaginator - A paginated list of issues.
     */
    public function getIssues(ListIssueRequest $request): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage('page');
        $params = [
            'page' => $page,
        ];

        if($request->project){
            $request->merge([
                'project_id' => $request->project,
            ]);
        }

        $data = $this->getData($params);
        $issues = $this->pagination($data, $page);

        return $issues;
    }

    /**
     * Get a paginated list of issues based on the provided request.
     *
     * @param ListIssueRequest $request - The request with filters and pagination parameters.
     * @return LengthAwarePaginator - A paginated list of issues.
     */
    public function getIssuesT(ListIssueRequest $request)
    {
        $page = Paginator::resolveCurrentPage('page');

        if($page){
            $request->merge([
                'page' => $page,
            ]);
        }
        if($request->project){
            $request->merge([
                'project_id' => $request->project,
            ]);
            unset($request['project']);
        }
        if($request->search){
            $request->merge([
                'subject' => $request->search,
            ]);
            unset($request['search']);
        }
        if($request->tracker){
            $request->merge([
                'tracker_id' => $request->tracker,
            ]);
            unset($request['tracker']);
        }
        if($request->status){
            $request->merge([
                'status_id' => $request->status,
            ]);
            unset($request['status']);
        }

        $queryString = http_build_query($request->all());
        $data = $this->getData($queryString);
        $issues = $this->pagination($data, $page);

        return $issues;
    }

    /**
     * Get options for filtering issues.
     *
     * @return mixed - An array of issue options.
     */
    public function getIssuesOptions(): mixed
    {
        $projects = [];
        $projectsOptions = [];
        $data = $this->getData();

        if (isset($data[$this->getPath()])) {
            $projects = $data[$this->getPath()];
        }

        foreach ($projects as $project) {
            $projectsOptions[] = [
                'id' => $project['id'],
                'name' => $project['name'],
            ];
        }

        return $projectsOptions;
    }
}
