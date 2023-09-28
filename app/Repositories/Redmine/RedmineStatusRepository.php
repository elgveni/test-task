<?php
namespace App\Repositories\Redmine;

use App\Repositories\StatusRepositoryInterface;

class RedmineStatusRepository extends RedmineCoreRepository  implements StatusRepositoryInterface
{
    /**
     * Get the Redmine API path for issue statuses.
     *
     * @return string - The Redmine API path for issue statuses.
     */
    protected function getPath(): string
    {
        return 'issue_statuses';
    }

    /**
     * Get options for filtering issue statuses.
     *
     * @return mixed - An array of issue status options.
     */
    public function getStatusOptions(): mixed
    {
        $data = $this->getData();
        $trackers = [];

        if (isset($data[$this->getPath()])) {
            $trackers = $data[$this->getPath()];
        }

        return $trackers;
    }
}
