<?php

namespace App\Repositories;

interface StatusRepositoryInterface
{
    /**
     * Get options for statuses.
     *
     * @return mixed - An array of status options.
     */
    public function getStatusOptions(): mixed;
}
