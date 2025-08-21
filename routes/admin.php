<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::controller(LoginController::class)->group(function ()
{
    Route::get('', 'showLoginForm')->name('login');
    Route::post('/', 'login')->name('login.submit');
});

Route::middleware('auth:admin')->group(function ()
{
    Route::prefix('dashboard')->controller(DashboardController::class)->group(function ()
    {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile', 'profile')->name('profile');
        Route::post('/admin/logout', 'logout')->name('logout');
        Route::get('/change-password', 'changePassword')->name('change-password');
    });


    Route::resource('users', UserController::class);

    Route::prefix('settings')->controller(SettingController::class)->group(function ()
    {
        Route::get('/', 'index')->name('settings.index');
        Route::post('/', 'update')->name('settings.update');
    });

    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);

    // SubCategory routes
    Route::prefix('subcategories')->controller(SubCategoryController::class)->group(function ()
    {
        Route::get('/', 'index')->name('subcategories.index');
        Route::get('/create', 'create')->name('subcategories.create');
        Route::post('/', 'store')->name('subcategories.store');
        Route::get('/{id}/edit', 'edit')->name('subcategories.edit');
        Route::put('/{id}', 'update')->name('subcategories.update');
        Route::delete('/{id}', 'destroy')->name('subcategories.destroy');
    });

    Route::resource('products', ProductController::class);

});

