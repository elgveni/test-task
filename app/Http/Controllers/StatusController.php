<?php

namespace App\Http\Controllers;

use App\Repositories\StatusRepositoryInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class StatusController extends BaseController
{
    private $statusRepository;

    public function __construct()
    {
        $this->statusRepository = app(StatusRepositoryInterface::class);
    }

    /**
     * Get options for statuses.
     *
     * @return JsonResponse - JSON response containing status options.
     */
    public function getOptions(): JsonResponse
    {
        $statuses = $this->statusRepository->getStatusOptions();

        return response()->json($statuses);
    }
}
