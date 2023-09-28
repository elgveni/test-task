<?php
namespace App\Repositories\Database;

use App\Models\Category as Model;
use App\Repositories\CategoryRepositoryInterface;

class DatabaseCategoryRepository extends DatabaseCoreRepository implements CategoryRepositoryInterface
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
     * Get category options.
     *
     * @param  string|null $projectIdentify - The identifier of the project (optional).
     * @return mixed - An array of category options (name and id).
     */
    public function getCategoryOptions($projectIdentify = null): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $categories = $eventsBuilder->select(['name', 'id'])->get()->toArray();
        return $categories;
    }
}
