<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('home', [
        'title' => 'Guest',
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('update.profile');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/users-managements', [UserController::class, 'index'])->name('users.managements.index');
    Route::delete('/users-managements/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users-managements/create', [UserController::class, 'create'])->name('users.managements.create');
    Route::post('/users-managements/create', [UserController::class, 'store'])->name('users.managements.store');
    Route::get('/users-managements/{user}/edit', [UserController::class, 'edit'])->name('users.managements.edit');
    Route::put('/users-managements/{user}', [UserController::class, 'update'])->name('users.managements.update');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('admin.posts.show');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/user/{id}/posts', [PostController::class, 'userPosts'])->name('admin.posts');
    Route::get('/category/{slug}', [PostController::class, 'category'])->name('admin.category.posts');

    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('admin.bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('admin.bookmarks.store');
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('admin.bookmarks.destroy');

    Route::get('/api/chart-data', [PostController::class, 'getChartData']);

    Route::post('/comments', [CommentController::class, 'store'])->name('admin.comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');

    Route::get('/settings', function () {
        return view('components.settings', [
            'title'  => 'Settings',
            'active' => 'settings',
        ]);
    })->name('admin.settings');

});

Route::group(['middleware' => 'role:user', 'prefix' => 'user'], function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');

    Route::get('/my-posts', [PostController::class, 'myPost'])->name('my.posts');
    Route::get('/posts', [PostController::class, 'index'])->name('user.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('user.posts.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('user.posts.store');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('user.posts.show');
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('user.posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('user.posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('user.posts.destroy');

    Route::get('/archived', [PostController::class, 'archived'])->name('user.archived');

    Route::get('/user/{id}/posts', [PostController::class, 'userPosts'])->name('user.posts');
    Route::get('/category/{slug}', [PostController::class, 'category'])->name('user.category.posts');

    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('user.bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('user.bookmarks.store');
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('user.bookmarks.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notifications.index');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('user.notifications.destroy');
    Route::post('/notifications/clear', [NotificationController::class, 'clear'])->name('user.notifications.clear');

    Route::post('/comments', [CommentController::class, 'store'])->name('user.comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('user.comments.destroy');


    Route::get('/settings', function () {
        return view('components.settings', [
            'title'  => 'Settings',
            'active' => 'settings',
        ]);
    })->name('user.settings');
});
