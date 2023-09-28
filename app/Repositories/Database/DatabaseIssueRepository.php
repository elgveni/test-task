<?php
namespace App\Repositories\Database;

use App\Filters\IssueFilter;
use App\Http\Requests\Issue\ListIssueRequest;
use App\Models\Issue as Model;
use App\Repositories\IssueRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DatabaseIssueRepository extends DatabaseCoreRepository implements IssueRepositoryInterface
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
     * Get a paginated list of issues based on the provided search and filter criteria.
     *
     * @param  ListIssueRequest $request - The request object containing filter criteria.
     * @return LengthAwarePaginator - Paginated list of issues.
     */
    public function getIssues(ListIssueRequest $request): LengthAwarePaginator
    {

        $eventsBuilder = $this->startConditions()->newQuery();

        $eventsBuilder->with([
            'project',
            'tracker',
            'status',
            'category'
        ]);

        $request->merge([
            'search' => $request->search ? strtolower($request->search) : null,
        ]);

        $issues = (new IssueFilter($eventsBuilder, $request))->apply()->orderBy('created_at', 'desc')->paginate(10);

        return $issues;
    }

    /**
     * Get issue options (name and id) for listing or selection purposes.
     *
     * @return mixed - An array of issue options (name and id).
     */
    public function getIssuesOptions(): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $projects = $eventsBuilder->select(['name', 'id'])->get()->toArray();
        return $projects;
    }
}
