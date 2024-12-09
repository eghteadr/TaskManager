<?php

namespace App\Providers;

use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, function ($app) {
            $route = request()->route()->getName();
            if (str_contains($route, 'project')) {
                return new ProjectRepository(new \App\Models\Project());
            }elseif (str_contains($route, 'team')){
                return new TeamRepository(new \App\Models\Team());
            }
            else{
                return new BaseRepository();
            }

        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
