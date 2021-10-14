<?php

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\Front\CommentController as FrontCommentController;
use App\Http\Controllers\Front\ContactController as FrontContactController;
use App\Http\Controllers\Front\PageController as FrontPageController;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Front\PostController as BackPostController;

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

//route vers la page d'administration
Route::view('admin', 'back.layout');

Route::prefix('admin')->group(function () {
    Route::middleware('redac')->group(function () {
        Route::name('admin')->get('/', [AdminController::class, 'index']);
        Route::name('purge')->put('purge/{model}', [AdminController::class, 'purge']);
    });
    /*
    Route::middleware('redac')->group(function () {
        Route::resource('posts', BackPostController::class)->except('show');
    });
    Route::middleware('admin')->group(function () {
        Route::name('posts.indexnew')->get('newposts', [BackPostController::class, 'index']);
    });*/
});

Route::prefix('admin')->group(function () {
    Route::middleware('redac')->group(function () {
        Route::resource('posts', BackPostController::class)->except(['show','create']);
        Route::name('posts.create')->get('posts/create/{id?}', [BackPostController::class, 'create']);
    });
    Route::middleware('admin')->group(function () {
        Route::name('posts.indexnew')->get('newposts', [BackPostController::class, 'index']);
        Route::name('posts.create')->get('posts/create/{id?}', [BackPostController::class, 'create']);
    });
});

//route de la vue home
Route::name('home')->get('/', [FrontPostController::class, 'index']);

 //Route::get('/', function () {
 //   return view('welcome');
 //});
//routes pour les fichiers
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

//Route::get('/dashboard', function () {
  //  return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//ensemble de route pour Post
Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
    Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);
    Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);
    Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);
    Route::name('posts.search')->get('', [FrontPostController::class, 'search']);
    Route::name('posts.comments')->get('{post}/comments', [FrontCommentController::class, 'comments']);
    Route::name('posts.comments.store')->post('{post}/comments', [FrontCommentController::class, 'store'])->middleware('auth');
    Route::name('front.comments.destroy')->delete('comments/{comment}', [FrontCommentController::class, 'destroy']);
});

//route pour contact
Route::resource('contacts', FrontContactController::class, ['only' => ['create', 'store']]);

//route pour les pages CMS
Route::name('page')->get('page/{page:slug}', FrontPageController::class);
require __DIR__.'/auth.php';
