<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\ReportArticleController;
use App\Http\Controllers\UserManagementController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
/*Socil media login */
Route::get('login/google', [LoginController::class,'redirectToGoogle'])->name("login.google");
Route::get('login/google/callback', [LoginController::class,'handleGoogleCallback']);
Route::get('login/facebook', [LoginController::class,'redirectToFacebook'])->name("login.facebook");
Route::get('login/facebook/callback', [LoginController::class,'handleFacebookCallback']);


/*Frontend*/
Route::middleware(["auth","isBanned"])->group(function(){
    Route::get("/",[FrontendController::class,"index"])->name("index.frontend");
    Route::post("/followers/remove-followed",[UserRequestController::class,"removeFollowed"])->name("follower.removeFollower");
    Route::get("/article-create",[FrontendController::class,"create"])->name("create.article");
    Route::post("/article-store",[FrontendController::class,"store"])->name("store.article");
    Route::get("/article-edit/{article:slug}",[FrontendController::class,"edit"])->name("edit.farticle");
    Route::post("/article-thumbnail-delete",[FrontendController::class,"thumbnailRemove"])->name("remove.thumbnail");
    Route::put("/article-update/{article:slug}",[FrontendController::class,"update"])->name("update.farticle");
    Route::get("/article-detail/{article:slug}",[FrontendController::class,"show"])->name("show.farticle");
    Route::post("/article/comment",[FrontendController::class,"comStore"])->name("store.fcomment");
    Route::post("/load-message-count",[FrontendController::class,"loadmessageCount"])->name("countMessage.comment");
    Route::post("/react/{article:slug}/article",[FrontendController::class,"articleReactor"])->name("react.farticle");
    Route::delete("/article/{article:id}/delete",[FrontendController::class,"destroy"])->name("remove.farticle");
    Route::get("/report-article/{artilce:slug}",[FrontendController::class,"storeReport"])->name("set.freport");
    Route::get("/profile/{user:username}",[FrontendController::class,"profileUser"])->name("profile.user");
    Route::get("/profile/{user:username}/edit",[FrontendController::class,"editProfileUser"])->name("profile.edit.user");
    Route::put("/profile/{user:username}/update",[FrontendController::class,"updateProfileUser"])->name("profile.update.user");
    Route::post("/user/user-request/set-request",[FrontendController::class,"userRequeststore"])->name("set.userrequest");
    Route::post("/user/user-request/set-confirm",[FrontendController::class,"userRequestUpdate"])->name("set.confirm");
    Route::post("/user/user-request/remove-request",[FrontendController::class,"userRequestDestroy"])->name("remove.userrequest");
    Route::post("/user/user-request/remove-followed",[FrontendController::class,"destroyFollowed"])->name("remove.userfollowed");
    Route::post("/user/user-request/remove-pending",[FrontendController::class,"destroyRequest"])->name("remove.pending");
    Route::post("/user/user-request/follower-count",[FrontendController::class,"followerCount"])->name("follower.count");
    Route::get("/moom-medium/user-search",[FrontendController::class,"userSearch"])->name("user.usersearch");
    Route::get("/comment/{artilce:slug}/{comment:id}/update",[CommentController::class,"update"])->name("update.fcomment");
    Route::get("/search",[FrontendController::class,"filter"])->name("category.search");
    Route::get("/user-search",[FrontendController::class,"userFilter"])->name("user.search");

});






/*Dashboard */
Route::prefix("dashboard")->middleware(["isAdmin","isBanned"])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource("/article",ArticleController::class);
    Route::resource("/article-category",CategoryController::class);
    Route::get("/article/{article:slug}/detail",[ArticleController::class,"show"])->name("detail.article");
    Route::get("/article/{article:slug}/edit",[ArticleController::class,"edit"])->name("edit.article");
    Route::put("/article/{article:slug}/update",[ArticleController::class,"update"])->name("update.article");
    Route::post("/react/{article:slug}/article",[ArticleController::class,"articleReactor"])->name("react.article");
    Route::get("/article-lists",[ArticleController::class,"listArticle"])->name("article.lists");
    Route::get("/article-search",[ArticleController::class,"searchArticle"])->name("article.search");
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
    Route::get("/user/{user:username}/profile",[UserManagementController::class,"show"])->name("detail.user");
    Route::get("/report-article/{artilce:slug}",[ReportArticleController::class,"store"])->name("set.report");
    Route::get("/report-article/{reportarticle:id}/{article:slug}/update",[ReportArticleController::class,"update"])->name("update.report");
    Route::get("/report",[ReportArticleController::class,"index"])->name("index.report");
    Route::post("/report/remove",[ReportArticleController::class,"destroy"])->name("delete.report");
    Route::post("/comment/article",[CommentController::class,"store"])->name("store.comment");
    Route::post("/load-message-count",[CommentController::class,"loadmessageCount"])->name("countMessage.comment");
    Route::get("/comments",[CommentController::class,"index"])->name("index.comment");
    Route::get("/comment/{artilce:slug}/{comment:id}/update",[CommentController::class,"update"])->name("update.comment");
    Route::post("/comment/remove",[CommentController::class,"destroy"])->name("delete.comment");
    Route::get("/user-request",[UserRequestController::class,"index"])->name("index.request");
    Route::post("/user-request/set-request",[UserRequestController::class,"store"])->name("set.request");
    Route::post("/user-request/set-confirm",[UserRequestController::class,"update"])->name("set.confirm");
    Route::post("/user-request/remove-request",[UserRequestController::class,"destroy"])->name("remove.request");
    Route::post("/user-request/remove-followed",[UserRequestController::class,"destroyFollowed"])->name("remove.followed");
    Route::post("/user-request/remove-pending",[UserRequestController::class,"destroyRequest"])->name("remove.pending");
    Route::post("/user-request/follower-count",[UserRequestController::class,"followerCount"])->name("follower.count");
});
