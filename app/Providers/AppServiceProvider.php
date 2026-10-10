<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Profil;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('admin', function ($view) {
            $view->with('profilSekolah', ProfilSekolah::first());
        });
    }
}
