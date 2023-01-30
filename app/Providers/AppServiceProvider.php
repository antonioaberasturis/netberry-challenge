<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Netberry\TaskManager\Task\Domain\TaskRepository;
use Netberry\TaskManager\Category\Domain\CategoryRepository;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategoryRepository;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskEloquentRepository;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryEloquentRepository;
use Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent\TaskCategoryEloquentRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CategoryRepository::class, 
            CategoryEloquentRepository::class
        );
        $this->app->singleton(
            TaskRepository::class, 
            TaskEloquentRepository::class
        );

        $this->app->singleton(
            TaskCategoryRepository::class, 
            TaskCategoryEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
