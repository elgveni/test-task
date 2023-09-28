<?php

namespace App\Http\Controllers;

use App\Repositories\VersionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class VersionController extends BaseController
{
    private $versionRepository;

    public function __construct()
    {
        $this->versionRepository = app(VersionRepositoryInterface::class);
    }

    /**
     * Get options for versions based on project identifier.
     *
     * @param  string $projectIdentify - The identifier of the project.
     * @return JsonResponse - JSON response containing version options.
     */
    public function getOptions($projectIdentify): JsonResponse
    {
        $versions = $this->versionRepository->getVersionOptions($projectIdentify);

        return response()->json($versions);
    }
}
