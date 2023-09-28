<?php
namespace App\Repositories\Redmine;

use App\Repositories\VersionRepositoryInterface;

class RedmineVersionRepository extends RedmineCoreRepository  implements VersionRepositoryInterface
{
    /**
     * Get the Redmine API path for versions.
     *
     * @return string - The Redmine API path for versions.
     */
    protected function getPath(): string
    {
        return 'versions';
    }

    /**
     * Get options for filtering versions based on a project identifier.
     *
     * @param string|null $projectIdentify - The identifier of the project for which to fetch versions.
     *
     * @return mixed - An array of version options.
     */
    public function getVersionOptions($projectIdentify = null): mixed
    {
        $versions = [];
        if($projectIdentify) {
            $path = $this->baseUrl . '/projects/' . $projectIdentify . '/versions.json';

            $data = $this->getData(null, $path);


            if (isset($data[$this->getPath()])) {
                $versions = $data[$this->getPath()];
            }
        }
        return $versions;
    }
}
