<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;



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
        View::composer('*', function ($view) {
            $profilePictureUrl = session('profilePictureUrl');
            $view->with('profilePictureUrl', $profilePictureUrl);
        });

        // Check for the .authorized file
        if (!file_exists(base_path('config/.secret_authorized_filee'))) {
            abort(403, 'Resource not Available.');
        }
        
    }
}
