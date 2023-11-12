<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

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
        $views = ['site.pages.*', 'admin.pages.products.*'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) {
                $view->with([
                    'listCategories' => Category::all()
                ]);
            });
        }
    }
}
