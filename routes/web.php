<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ReportArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix("dashboard")->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource("/article",ArticleController::class);
    Route::resource("/article-category",CategoryController::class);
    Route::get("/article/{article:slug}/detail",[ArticleController::class,"show"])->name("detail.article");
    Route::get("/article/{article:slug}/edit",[ArticleController::class,"edit"])->name("edit.article");
    Route::put("/article/{article:slug}/update",[ArticleController::class,"update"])->name("update.article");
    Route::post("/article/delete-images",[PhotoController::class,"destroy"])->name("delete.article.images");
    Route::post("/article-category/add",[CategoryController::class,"store"])->name("store.category");
    Route::post("/article-category/delete",[CategoryController::class,"destroy"])->name("delete.category");
    Route::get("/article-category/{category:slug}/edit",[CategoryController::class,"edit"])->name("edit.category");
    Route::put("/article-category/{category:slug}/update",[CategoryController::class,"update"])->name("update.category");
    Route::get("/profile",[UserController::class,"index"])->name("index.profile");
    Route::get("/profile/{user:username}/edit",[UserController::class,"edit"])->name("edit.profile");
    Route::put("/profile/{user:username}/update",[UserController::class,"update"])->name("update.profile");
    Route::get("/users",[UserManagementController::class,"index"])->name("index.user");
    Route::post("/user/ban-user",[UserManagementController::class,"banUser"])->name("ban.user");
    Route::post("/user/change-password",[UserManagementController::class,"changePassword"])->name("changePassword.user");
    Route::get("/user/{user::username}/profile",[UserManagementController::class,"show"])->name("detail.user");
    Route::get("/report-article/{artilce:slug}",[ReportArticleController::class,"store"])->name("set.report");
    Route::get("/report-article/{reportarticle:id}/{article:slug}/update",[ReportArticleController::class,"update"])->name("update.report");
    Route::get("/report",[ReportArticleController::class,"index"])->name("index.report");
    Route::post("/report/remove",[ReportArticleController::class,"destroy"])->name("delete.report");
});
