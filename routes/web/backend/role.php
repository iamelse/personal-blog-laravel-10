<?php

use App\Http\Controllers\Web\BackEnd\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/role', [RoleController::class, 'index'])->name('be.role.and.permission.index');
Route::get('/role/create', [RoleController::class, 'create'])->name('be.role.and.permission.create');
Route::post('/role/store', [RoleController::class, 'store'])->name('be.role.and.permission.store');
Route::get('/role/{role:slug}', [RoleController::class, 'edit'])->name('be.role.and.permission.edit');
Route::put('/role/{role:slug}', [RoleController::class, 'update'])->name('be.role.and.permission.update');
Route::delete('/role/{role:slug}', [RoleController::class, 'destroy'])->name('be.role.and.permission.destroy');
Route::get('/role/mass/destroy', [RoleController::class, 'massDestroy'])->name('be.role.and.permission.mass.destroy');
    
Route::get('/role/{role:slug}/permission', [RoleController::class,'editPermission'])->name('be.role.and.permission.edit.permissions');
Route::put('/role/{role:slug}/permission', [RoleController::class,'updatePermission'])->name('be.role.and.permission.update.permissions');