<?php

use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->names('admin.user');
Route::resource('roles', RolController::class)->names('admin.rol'); 
Route::resource('permisos', PermisoController::class)->names('admin.permiso');  

