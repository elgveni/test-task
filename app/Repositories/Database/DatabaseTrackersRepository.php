<?php
namespace App\Repositories\Database;

use App\Models\Tracker as Model;
use App\Repositories\TrackerRepositoryInterface;

class DatabaseTrackersRepository extends DatabaseCoreRepository implements TrackerRepositoryInterface
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
     * Get tracker options (name and id) for listing or selection purposes.
     *
     * @return mixed - An array of tracker options (name and id).
     */
    public function getTrackerOptions(): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $categories = $eventsBuilder->select(['name', 'id'])->get()->toArray();
        return $categories;
    }
}
