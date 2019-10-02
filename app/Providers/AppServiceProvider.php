<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\ProductComposer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        View::composer(['front.index'], CategoryComposer::class);
        View::composer(['front.index'], ProductComposer::class);
    }
}
