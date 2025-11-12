<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\{RoleController, UserController, AdminController, SettingController, ProductController, CategoryController, DashboardController, PermissionController, Auth\LoginController, SubCategoryController, EmailTemplateController, RolePermissionController};
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::controller(LoginController::class)->group(function ()
{
    Route::get('', 'showLoginForm')->name('login');
    Route::post('/', 'login')->name('login.submit');
});

Route::prefix('admin')->group(function () 
{
    // Forgot password
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset password
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::any('/cache/clear', function ()
{
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Application cache cleared successfully!');
})->name('cache.clear');

Route::middleware('auth.any')->group(function ()
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
    // User change password routes
    Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change_password.update');
    
    // Assign Permission to Users
    Route::get('users/{user}/assign-permission', [UserController::class, 'assignPermission'])->name('users.assign_permission');
    Route::post('users/{user}/assign-permission', [UserController::class, 'storePermission'])->name('users.store_permission');

    Route::prefix('settings')->controller(SettingController::class)->group(function ()
    {
        Route::get('/', 'index')->name('settings.index');
        Route::post('/', 'update')->name('settings.update');
    });

    // Resource routes
    Route::resources([
        'roles' => RoleController::class,
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'permissions' => PermissionController::class,
        'email-templates' => EmailTemplateController::class,
    ]);

    Route::get('role-permissions/{role?}', [RolePermissionController::class, 'index'])->name('role-permissions.index');
    Route::resource('role-permissions', RolePermissionController::class)->except(['index']);

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
});

