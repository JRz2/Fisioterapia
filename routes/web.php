<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('', [HomeController::class, 'index'])->name('home.index');

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('admin/users/profile', [UserController::class, 'profile'])->name('admin.user.profile');
Route::view('/esqueleto', 'doctor.model.esqueleto');
Route::view('/craneo', 'doctor.model.craneo');
Route::view('/musculo ', 'doctor.model.musculo');
Route::view('/minferior', 'doctor.model.minferior');
Route::view('/msuperior', 'doctor.model.msuperior');
Route::view('/mcara', 'doctor.model.mcara');



