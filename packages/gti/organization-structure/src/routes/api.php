<?php

use GTI\OrganizationStructure\Controllers\DepartmentController;
use GTI\OrganizationStructure\Controllers\DivisionController;
use GTI\OrganizationStructure\Controllers\OrganizationController;
use GTI\OrganizationStructure\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'organizations'], function () {
        Route::get('/', [OrganizationController::class, 'index'])->name('organizations.index');
        Route::get('/{id}', [OrganizationController::class, 'show'])->name('organizations.show');
        Route::post('/add', [OrganizationController::class, 'store'])->name('organizations.store');
        Route::post('/{id}/update', [OrganizationController::class, 'update'])->name('organizations.update');
        Route::post('/{id}/delete', [OrganizationController::class, 'destroy'])->name('organizations.delete');
    });
    Route::group(['prefix' => 'divisions'], function () {
        Route::get('/all', [DivisionController::class, 'all'])->name('divisions.all');
        Route::get('/', [DivisionController::class, 'index'])->name('divisions.index');
        Route::get('/{id}', [DivisionController::class, 'show'])->name('divisions.show');
        Route::post('/add', [DivisionController::class, 'store'])->name('divisions.store');
        Route::post('/{id}/update', [DivisionController::class, 'update'])->name('divisions.update');
        Route::post('/{id}/delete', [DivisionController::class, 'destroy'])->name('divisions.delete');
    });
    Route::group(['prefix' => 'departments'], function () {
        Route::get('/all', [DepartmentController::class, 'all'])->name('departments.all');
        Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/{id}', [DepartmentController::class, 'show'])->name('departments.show');
        Route::post('/add', [DepartmentController::class, 'store'])->name('departments.store');
        Route::post('/{id}/update', [DepartmentController::class, 'update'])->name('departments.update');
        Route::post('/{id}/delete', [DepartmentController::class, 'destroy'])->name('departments.delete');
    });
    Route::group(['prefix' => 'positions'], function () {
        Route::get('/all', [PositionController::class, 'all'])->name('positions.all');
        Route::get('/', [PositionController::class, 'index'])->name('positions.index');
        Route::get('/{id}', [PositionController::class, 'show'])->name('positions.show');
        Route::post('/add', [PositionController::class, 'store'])->name('positions.store');
        Route::post('/{id}/update', [PositionController::class, 'update'])->name('positions.update');
        Route::post('/{id}/delete', [PositionController::class, 'destroy'])->name('positions.delete');
    });

});
