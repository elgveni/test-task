<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    /**
     * Get category options for a specific project.
     *
     * This method retrieves category options for a specified project based on its identifier.
     *
     * @param string $projectIdentifier - The identifier of the project.
     * @return JsonResponse - JSON response containing category options.
     */
    public function getOptions($projectIdentify): JsonResponse
    {
        $categoryOptions = $this->categoryRepository->getCategoryOptions($projectIdentify);

        return response()->json($categoryOptions);
    }
}
