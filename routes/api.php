<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'reset']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('update-password', [UserController::class, 'updatePassword']);
    Route::get('/', [UserController::class, 'show'])->name('user.show');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
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
Route::get('/export', [EmployeeController::class, 'export'])->name('employees.export');
Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('/add', [EmployeeController::class, 'store'])->name('employees.store');
    Route::post('/add-bulk', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('/{id}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
    Route::resource('users', UserController::class);
    Route::resource('position', PositionController::class);
    Route::resource('department', DepartmentController::class);
});
