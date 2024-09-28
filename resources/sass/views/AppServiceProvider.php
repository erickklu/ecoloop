<?php

namespace App\Providers;

use App\VoyagerActions\RequestedEntryAcceptAction;
use App\VoyagerActions\RequestedEntryAction;
use App\VoyagerActions\RequestedEntryUserAction;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
       /*  Paginator::defaultView('vendor.pagination.default'); */
        
        /* Paginator::useBootstrapFive(); */
      /*   Paginator::useBootstrapFour();
        Paginator::useBootstrap(); */
        Voyager::addAction(RequestedEntryAction::class);
        Voyager::addAction(RequestedEntryUserAction::class);
        Voyager::addAction(RequestedEntryAcceptAction::class);
    }
}
