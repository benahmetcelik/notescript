<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
})->name('home');


Auth::routes();

Route::post('save-note',[HomeController::class,'saveNote'])->name('save-note');
//fast_logout route

Route::get('/fast-logout',
    function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('fast-logout');


Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/my-notes', [UserController::class, 'myNotes'])->name('my-notes');
Route::get('delete-note/{note}',[HomeController::class,'deleteNote'])->name('delete-note');
Route::get('admin/',[AdminController::class,'index'])->name('admin')->middleware('admin');
Route::get('admin/back-up',[AdminController::class,'backup'])->name('admin.backup')->middleware('admin');
Route::get('admin/users',[AdminController::class,'users'])->name('admin.users')->middleware('admin');
Route::get('admin/notes',[AdminController::class,'notes'])->name('admin.notes')->middleware('admin');
Route::get('admin/banners',[AdminController::class,'banners'])->name('admin.banners')->middleware('admin');
Route::get('admin/settings',[AdminController::class,'settings'])->name('admin.settings')->middleware('admin');
Route::get('admin/colors',[AdminController::class,'colors'])->name('admin.colors')->middleware('admin');
Route::post('admin/colors/store',[AdminController::class,'colorsStore'])->name('admin.colors.store')->middleware('admin');
Route::post('admin/settings/store',[AdminController::class,'settingsStore'])->name('admin.settings.store')->middleware('admin');
Route::post('admin/banners/store',[AdminController::class,'bannersStore'])->name('admin.banners.store')->middleware('admin');
Route::get('admin/notes/{link}',[AdminController::class,'notesDelete'])->name('admin.notes.delete')->middleware('admin');
Route::post('admin/users/store',[AdminController::class,'user_store'])->name('admin.users.store')->middleware('admin');
Route::get('admin/users/delete/{id}',[AdminController::class,'user_delete'])->name('admin.users.delete')->middleware('admin');
Route::get('admin/banners/delete/{id}',[AdminController::class,'banner_delete'])->name('admin.banners.delete')->middleware('admin');

Route::get('/banner/{banner}',[HomeController::class,'clickBanner'])->name('clickBanner');
Route::get('/{note}',[HomeController::class,'getNote'])->name('get-note');
