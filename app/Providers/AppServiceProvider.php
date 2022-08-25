<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Category;
use App\Models\ReportArticle;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('isAdmin',function(){
            return Auth::user()->role === "0";
        });
       View::share("categories",Category::all()->last()->get());
       View::share("reports",ReportArticle::orderBy("id","DESC")->get());
       View::share("reportActive",ReportArticle::all()->where("status","active")->count());
    }
    
}
