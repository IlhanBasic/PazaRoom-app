<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\Contact_MessagesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertyTagsController;

Route::get('/', [PropertiesController::class, 'index'])->name('home');
Route::get('/policy',function () {
    return view('policy');
});
Route::get('/conditions',function () {
    return view('conditions');
});
Route::get('/faq',function () {
    return view('faq');
});
Route::get('/about',function () {
    return view('about');
})->name('about');
Route::prefix('contact')->group(function () {
    Route::get('/', [Contact_MessagesController::class, 'contact'])->name('contact');
    Route::post('/create', [Contact_MessagesController::class, 'store'])->name('contact_create');
    Route::get('/{id}', [Contact_MessagesController::class, 'show'])->name('contact_show');
    Route::delete('/destroy/{id}', [Contact_MessagesController::class, 'destroy'])->name('contact_delete')->middleware('auth');
});
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::prefix('properties-tags')->group(function () {
    Route::get('/create', [PropertyTagsController::class, 'create'])->name('property_tags_create')->middleware('auth');
    Route::post('/store', [PropertyTagsController::class, 'store'])->name('property_tags_store')->middleware('auth');
    Route::get('/{id}/edit', [PropertyTagsController::class, 'edit'])->name('property_tag_edit')->middleware('auth');
    Route::post('/update/{id}', [PropertyTagsController::class, 'update'])->name('property_tag_update')->middleware('auth');
    Route::delete('/destroy/{id}', [PropertyTagsController::class, 'destroy'])->name('property_tag_delete')->middleware('auth');
});
Route::prefix('properties')->group(function () {
    Route::get('/', [PropertiesController::class, 'index'])->name('properties');
    Route::get('/create', [PropertiesController::class, 'create'])->name('properties_create')->middleware('auth');
    Route::post('/store', [PropertiesController::class, 'store'])->name('properties_store')->middleware('auth');
    Route::get('/{id}/edit', [PropertiesController::class, 'edit'])->name('property_edit')->middleware('auth');
    Route::get('/{id}', [PropertiesController::class, 'show'])->name('property_show');
    Route::post('/update/{id}', [PropertiesController::class, 'update'])->name('property_update')->middleware('auth');
    Route::delete('/destroy/{id}', [PropertiesController::class, 'destroy'])->name('property_delete')->middleware('auth');
    Route::patch('/accept/{id}', [PropertiesController::class, 'accept'])->name('property_accept')->middleware('auth');
    Route::patch('/decline/{id}', [PropertiesController::class, 'decline'])->name('property_decline')->middleware('auth');
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogsController::class, 'index'])->name('blogs');
    Route::get('/create', [BlogsController::class, 'create'])->name('blog_create')->middleware('auth');
    Route::post('/store', [BlogsController::class, 'store'])->name('blog_store')->middleware('auth');
    Route::get('/{id}/edit', [BlogsController::class, 'edit'])->name('blog_edit')->middleware('auth');
    Route::patch('/update/{id}', [BlogsController::class, 'update'])->name('blog_update')->middleware('auth');
    Route::delete('/destroy/{id}', [BlogsController::class, 'destroy'])->name('blog_delete')->middleware('auth');
});

Route::prefix('users')->group(function () {
    Route::get('/register', [UsersController::class, 'create'])->name('register');  
    Route::post('/register', [UsersController::class, 'store'])->name('register_user');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit_user')->middleware('auth');
    Route::post('/update/{id}', [UsersController::class, 'update'])->name('update_user')->middleware('auth');
    Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])->name('delete_user')->middleware('auth');
    Route::get('/login', [UsersController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/authenticate', [UsersController::class, 'authenticate'])->name('authenticate')->middleware('guest');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('/{id}', [UsersController::class, 'show'])->name('show_user')->middleware('auth');
    Route::get('/{id}/properties', [PropertiesController::class, 'ownerProperties'])->name('owner_properties')->middleware('auth');
    Route::get('{id}/favorites', [UsersController::class, 'favorites'])->name('favorites')->middleware('auth');
    Route::post('/favorites', [UsersController::class, 'store_favorite'])->name('store_favorite')->middleware('auth');
    Route::delete('{id}/favorites/{favorite_id}/delete', [UsersController::class, 'destroy_favorite'])
    ->name('destroy_favorite')
    ->middleware('auth');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin')->middleware('auth');
    Route::get('/create-user', [AdminController::class, 'create_user'])->name('create_user')->middleware('auth');
    Route::post('/store-user', [AdminController::class, 'store_user'])->name('store_user')->middleware('auth');
});
Route::prefix('reviews')->group(function () {
    Route::get('/create/{id}', [ReviewsController::class, 'create'])->name('review_create')->middleware('auth');
    Route::post('/', [ReviewsController::class, 'store'])->name('review_store')->middleware('auth');
    Route::delete('/destroy/{id}', [ReviewsController::class, 'destroy'])->name('review_delete')->middleware('auth');
});
Route::prefix('roles')->group(function () {
    Route::get('/create', [RolesController::class, 'create'])->name('role_create')->middleware('auth');
    Route::post('/store', [RolesController::class, 'store'])->name('role_store')->middleware('auth');
    Route::get('/{id}/edit', [RolesController::class, 'edit'])->name('role_edit')->middleware('auth');
    Route::patch('/update/{id}', [RolesController::class, 'update'])->name('role_update')->middleware('auth');
    Route::delete('/destroy/{id}', [RolesController::class, 'destroy'])->name('role_delete')->middleware('auth');
}); 