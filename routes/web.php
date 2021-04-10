<?php

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
    return view('auth.login');
})->middleware('guest')->name('index');

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])
    ->group(function (){
        Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');
        Route::match(['GET','POST'],'settings',[\App\Http\Controllers\SettingController::class,'settings'])
            ->name('settings')
            ->middleware(['can:manage-settings']);
        Route::prefix('manage')
            ->name('manage.')
            ->group(function(){
                Route::middleware(['can:list-permission'])
                    ->group(function() {
                        Route::name('permissions.')
                            ->prefix('permissions')
                            ->group(function () {
                                Route::match(['GET', 'POST'], 'import', [\App\Http\Controllers\Users\PermissionController::class,'import'])
                                    ->name('import');
                            });
                        Route::resource('permissions',\App\Http\Controllers\Users\PermissionController::class);
                    });
                Route::middleware(['can:list-role'])
                    ->group(function() {
                        Route::name('roles.')
                            ->prefix('roles')
                            ->group(function () {
                                Route::match(['GET', 'POST'], 'import', [\App\Http\Controllers\Users\PermissionController::class,'import'])
                                    ->name('import');
                            });
                        Route::resource('roles',\App\Http\Controllers\Users\RolesController::class);
                    });

                Route::middleware(['can:list-user'])
                    ->group(function() {
                        Route::name('users.')
                            ->prefix('users')
                            ->group(function () {
                                Route::match(['GET', 'POST'], 'import', [\App\Http\Controllers\Users\UserController::class,'import'])
                                    ->name('import');
                            });
                        Route::resource('users', \App\Http\Controllers\Users\UserController::class);
                    });
            });
    });
