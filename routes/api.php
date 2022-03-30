<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Master\DepartmentController;
use App\Http\Controllers\Master\PositionController;
use App\Http\Controllers\Role\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'roles'], function () {
            Route::get('/all', [RolesController::class, 'all'])->name('roles.all');
            Route::get('/permissions', [RolesController::class, 'list'])->name('roles.list');
            Route::get('/', [RolesController::class, 'index'])->name('roles.index');
            Route::get('/{id}', [RolesController::class, 'show'])->name('roles.show');
            Route::post('/add', [RolesController::class, 'store'])->name('roles.store');
            Route::post('/{id}/update', [RolesController::class, 'update'])->name('roles.update');
            Route::post('/{id}/delete', [RolesController::class, 'destroy'])->name('roles.delete');
            Route::get('/role-has-permissions/{id}', [RolesController::class, 'rolePermission'])->name('master.role.permission');
        });
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('users', UserController::class);
        Route::resource('employee', EmployeeController::class);
        Route::resource('position', PositionController::class);
        Route::resource('department', DepartmentController::class);
    });
