<?php
namespace App\Repositories\Database;

use App\Models\Status as Model;
use App\Repositories\StatusRepositoryInterface;

class DatabaseStatusRepository extends DatabaseCoreRepository implements StatusRepositoryInterface
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
     * Get status options (name and id) for listing or selection purposes.
     *
     * @return mixed - An array of status options (name and id).
     */
    public function getStatusOptions(): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $categories = $eventsBuilder->select(['name', 'id'])->get()->toArray();
        return $categories;
    }
}
