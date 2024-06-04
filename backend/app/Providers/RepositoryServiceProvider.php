<?php

namespace App\Providers;

use App\EloquentWriteRepository\EloquentWriteRepositoryInterface;
use App\Repositoryes\UserWriteRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            EloquentWriteRepositoryInterface::class,
            UserWriteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
