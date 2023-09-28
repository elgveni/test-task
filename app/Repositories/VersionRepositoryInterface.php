<?php

namespace App\Repositories;

interface VersionRepositoryInterface
{
    /**
     * Get options for versions.
     *
     * @param string|null $projectIdentify - An optional project identifier.
     *
     * @return mixed - An array of version options.
     */
    public function getVersionOptions($projectIdentify = null): mixed;
}
