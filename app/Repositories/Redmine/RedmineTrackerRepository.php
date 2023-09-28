<?php
namespace App\Repositories\Redmine;

use App\Repositories\TrackerRepositoryInterface;

class RedmineTrackerRepository extends RedmineCoreRepository  implements TrackerRepositoryInterface
{
    /**
     * Get the Redmine API path for trackers.
     *
     * @return string - The Redmine API path for trackers.
     */
    protected function getPath(): string
    {
        return 'trackers';
    }

    /**
     * Get options for filtering issue trackers.
     *
     * @return mixed - An array of issue tracker options.
     */
    public function getTrackerOptions(): mixed
    {
        $data = $this->getData();
        $trackers = [];

        if (isset($data[$this->getPath()])) {
            $trackers = $data[$this->getPath()];
        }

        return $trackers;
    }
}
