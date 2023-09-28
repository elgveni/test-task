<?php
namespace App\Repositories\Redmine;

use App\Http\Requests\Project\ListProjectRequest;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class RedmineProjectRepository extends RedmineCoreRepository  implements ProjectRepositoryInterface
{
    /**
     * Get the Redmine API path for projects.
     *
     * @return string - The Redmine API path for projects.
     */
    protected function getPath(): string
    {
        return 'projects';
    }

    /**
     * Get a paginated list of projects based on the provided request.
     *
     * @param ListProjectRequest $request - The request with filters and pagination parameters.
     * @return LengthAwarePaginator - A paginated list of projects.
     */
    public function getProjects(ListProjectRequest $request): LengthAwarePaginator
    {

        $page = Paginator::resolveCurrentPage('page');
        if($page){
            $request->merge([
                'page' => $page,
            ]);
        }
        $queryString = http_build_query($request->all());
        $data = $this->getData($queryString);

        $projects = $this->pagination($data, $page);

        return $projects;
    }

    /**
     * Get options for filtering projects.
     *
     * @return mixed - An array of project options.
     */
    public function getProjectsOptions(): mixed
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
                'identifier' => $project['identifier']
            ];
        }

        return $projectsOptions;
    }
}
