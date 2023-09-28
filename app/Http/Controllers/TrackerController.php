<?php

namespace App\Http\Controllers;

use App\Repositories\TrackerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class TrackerController extends BaseController
{
    private $trackerRepository;

    public function __construct()
    {
        $this->trackerRepository = app(TrackerRepositoryInterface::class);
    }

    /**
     * Get options for trackers.
     *
     * @return JsonResponse - JSON response containing tracker options.
     */
    public function getOptions(): JsonResponse
    {
        $trakers = $this->trackerRepository->getTrackerOptions();
        return response()->json($trakers);
    }
}
