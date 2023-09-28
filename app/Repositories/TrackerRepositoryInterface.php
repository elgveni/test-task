<?php

namespace App\Repositories;

interface TrackerRepositoryInterface
{
    /**
     * Get options for trackers.
     *
     * @return mixed - An array of tracker options.
     */
    public function getTrackerOptions(): mixed;
}
