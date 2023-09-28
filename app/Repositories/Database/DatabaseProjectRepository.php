<?php
namespace App\Repositories\Database;

use App\Http\Requests\Project\ListProjectRequest;
use App\Models\Project as Model;
use App\Filters\ProjectFilter;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DatabaseProjectRepository extends DatabaseCoreRepository implements ProjectRepositoryInterface
{
    /**
     * Get the model class for this repository.
     *
     * @return string - The fully qualified class name of the model.
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Get a paginated list of projects based on the provided search and filter criteria.
     *
     * @param  ListProjectRequest $request - The request object containing filter criteria.
     * @return LengthAwarePaginator - Paginated list of projects.
     */
    public function getProjects(ListProjectRequest $request): LengthAwarePaginator
    {
        $eventsBuilder = $this->startConditions()->newQuery();

        $eventsBuilder->with(['version']);

        $request->merge([
            'search' => $request->search ? strtolower($request->search) : null,
            'identifier' => $request->identifier ? strtolower($request->identifier) : null,
        ]);

        $projects = (new ProjectFilter($eventsBuilder, $request))->apply()->orderBy('created_at', 'desc')->paginate(10);

        return $projects;
    }

    /**
     * Get project options (name, id, and identifier) for listing or selection purposes.
     *
     * @return mixed - An array of project options (name, id, and identifier).
     */
    public function getProjectsOptions(): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $projects = $eventsBuilder->select(['name', 'id', 'identifier'])->get()->toArray();
        return $projects;
    }
}
