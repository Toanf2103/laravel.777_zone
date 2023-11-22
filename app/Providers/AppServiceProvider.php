<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Routing\UrlGenerator as RoutingUrlGenerator;

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
    public function boot(RoutingUrlGenerator $url): void
    {
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
        $views = ['site.pages.*', 'admin.pages.product.*', 'admin.pages.banner.*'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) {
                $view->with([
                    'listCategories' => Category::where('status',true)->get()
                ]);
            });
        }

        $views = ['admin.pages.product.*'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) {
                $view->with([
                    'listBrands' => Brand::all()
                ]);
            });
        }
    }
}
