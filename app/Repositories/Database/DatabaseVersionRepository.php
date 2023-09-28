<?php
namespace App\Repositories\Database;

use App\Models\Version as Model;
use App\Repositories\VersionRepositoryInterface;

class DatabaseVersionRepository extends DatabaseCoreRepository implements VersionRepositoryInterface
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
     * Get version options (name and id) for listing or selection purposes.
     *
     * @param string|null $projectIdentify - Optional project identifier.
     * @return mixed - An array of version options (name and id).
     */
    public function getVersionOptions($projectIdentify = null): mixed
    {
        $eventsBuilder = $this->startConditions()->newQuery();
        $versions = $eventsBuilder->select(['name', 'id'])->get()->toArray();
        return $versions;
    }
}
