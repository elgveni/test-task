<?php
namespace App\Repositories\Redmine;

use App\Repositories\CategoryRepositoryInterface;

class RedmineCategoryRepository extends RedmineCoreRepository  implements CategoryRepositoryInterface
{
    /**
     * Get the Redmine API path for issue categories.
     *
     * @return string - The Redmine API path for issue categories.
     */
    protected function getPath(): string
    {
        return 'issue_categories';
    }

    /**
     * Get category options (if available) for a specific project.
     *
     * @param string|null $projectIdentify - Optional project identifier.
     * @return mixed - An array of category options for the specified project.
     */
    public function getCategoryOptions($projectIdentify = null): mixed
    {
        $categories = [];
        if($projectIdentify) {
            $path = $this->baseUrl . '/projects/' . $projectIdentify . '/issue_categories.json';

            $data = $this->getData(null, $path);


            if (isset($data[$this->getPath()])) {
                $categories = $data[$this->getPath()];
            }
        }
        return $categories;
    }
}
