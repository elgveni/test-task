<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Database\DatabaseCategoryRepository;
use App\Repositories\Database\DatabaseIssueRepository;
use App\Repositories\Database\DatabaseProjectRepository;
use App\Repositories\Database\DatabaseStatusRepository;
use App\Repositories\Database\DatabaseTrackersRepository;
use App\Repositories\Database\DatabaseVersionRepository;
use App\Repositories\IssueRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\Redmine\RedmineCategoryRepository;
use App\Repositories\Redmine\RedmineIssueRepository;
use App\Repositories\Redmine\RedmineProjectRepository;
use App\Repositories\Redmine\RedmineStatusRepository;
use App\Repositories\Redmine\RedmineTrackerRepository;
use App\Repositories\Redmine\RedmineVersionRepository;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TrackerRepositoryInterface;
use App\Repositories\VersionRepositoryInterface;
use App\Services\Database\DatabaseIssueService;
use App\Services\Database\DatabaseProjectService;
use App\Services\IssueServiceInterface;
use App\Services\ProjectServiceInterface;
use App\Services\Redmine\RedmineIssueService;
use App\Services\Redmine\RedmineProjectService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(config('app.data_source') === 'database') {
            // Services
            $this->app->bind(IssueServiceInterface::class, DatabaseIssueService::class);
            $this->app->bind(ProjectServiceInterface::class, DatabaseProjectService::class);
            // Repositories
            $this->app->bind(IssueRepositoryInterface::class, DatabaseIssueRepository::class);
            $this->app->bind(ProjectRepositoryInterface::class, DatabaseProjectRepository::class);
            $this->app->bind(CategoryRepositoryInterface::class, DatabaseCategoryRepository::class);
            $this->app->bind(TrackerRepositoryInterface::class, DatabaseTrackersRepository::class);
            $this->app->bind(StatusRepositoryInterface::class, DatabaseStatusRepository::class);
            $this->app->bind(VersionRepositoryInterface::class, DatabaseVersionRepository::class);
        } else {
            // Services
            $this->app->bind(IssueServiceInterface::class, RedmineIssueService::class);
            $this->app->bind(ProjectServiceInterface::class, RedmineProjectService::class);
            // Repositories
            $this->app->bind(IssueRepositoryInterface::class, RedmineIssueRepository::class);
            $this->app->bind(ProjectRepositoryInterface::class, RedmineProjectRepository::class);
            $this->app->bind(CategoryRepositoryInterface::class, RedmineCategoryRepository::class);
            $this->app->bind(TrackerRepositoryInterface::class, RedmineTrackerRepository::class);
            $this->app->bind(StatusRepositoryInterface::class, RedmineStatusRepository::class);
            $this->app->bind(VersionRepositoryInterface::class, RedmineVersionRepository::class);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
