<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ReportArticle;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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
        Paginator::useBootstrapFive();
       View::share("categories",Category::all()->last()->get());
       View::share("reports",ReportArticle::orderBy("id","DESC")->get());
       View::share("reportActive",ReportArticle::all()->where("status","active")->count());
    }
    
}
