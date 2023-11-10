<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;

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
        $views = ['site.pages.*', 'admin.pages.products.*', 'admin.pages.banner.*'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) {
                $view->with([
                    'listCategories' => Category::all()
                ]);
            });
        }
    }
}
