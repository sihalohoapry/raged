<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\InformationController::class, 'index'])->name('home');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::view('/dashboar', '/page/dashboard')->name('dashboard')->middleware('auth');
Route::view('/create-information', '/page/create-information')->name('create-information')->middleware('auth');
Route::resource('information', InformationController::class)->middleware('auth');
Route::resource('materi', MateriController::class)->middleware('auth');
Route::get('/info-guru',[InformationController::class,'info_guru'])->name('info-guru')->middleware('auth');
Route::get('/info-siswa',[InformationController::class,'info_siswa'])->name('info-siswa')->middleware('auth');
Route::post('rate/{id}', [RateController::class,'makeRate'])->name('make-rate')->middleware('auth');
Route::match(['get', 'post'], 'show/{id}', [MateriController::class,'showAndAddView'])->name('show');
Route::match(['get', 'post'], 'show/informasi/{id}', [InformationController::class,'showAndAddInfoView'])->name('show-add-info');
Route::get('detail-guru/{id}', [InformationController::class,'showTeacher'])->name('show-teacher');
Route::match(['get','post'], 'profile/{id}', [UserController::class,'profile'])->name('profile');
Route::post('profile/update-profile/{id}', [UserController::class,'updateProfile'])->name('update-profile');
Route::match(['get', 'post'],'profile/status/{id}', [UserController::class,'status'])->name('status');
// Route::match(['get', 'post'], 'show/{id}', [MateriController::class,'showAndAddView'])->name('show-siswa');
// Route::match(['get', 'post'], 'show/{id}', [InformationController::class,'showInfo'])->name('show-informasi');
