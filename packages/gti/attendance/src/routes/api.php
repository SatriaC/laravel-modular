<?php

use GTI\Attendance\Controllers\AttendanceController;
use GTI\OrganizationStructure\Controllers\DepartmentController;
use GTI\OrganizationStructure\Controllers\DivisionController;
use GTI\OrganizationStructure\Controllers\OrganizationController;
use GTI\OrganizationStructure\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'attendances'], function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/statistic', [AttendanceController::class, 'statistic'])->name('attendances.statistic');
        Route::get('/{id}', [AttendanceController::class, 'show'])->name('attendances.show');
        Route::post('/in', [AttendanceController::class, 'checkIn'])->name('attendances.check.in');
        Route::post('/{id}/out', [AttendanceController::class, 'checkOut'])->name('attendances.check.out');
        Route::post('/{id}/approve', [AttendanceController::class, 'approve'])->name('attendances.approve');
        Route::post('/{id}/reject', [AttendanceController::class, 'reject'])->name('attendances.reject');
    });

});
