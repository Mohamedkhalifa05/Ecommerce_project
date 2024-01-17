<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(["auth","role:admin"])->group(function() {

    Route::get('/admin/dashboard', [AdminController::class,"Admin_Dashboard"])->name('Admin_Dashboard');

    Route::get('/admin/logout', [AdminController::class,"admin_logout"])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class,"admin_profile"])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class,"admin_profile_store"])->name('admin.profile.store');

    

});// Middleware Admin 
Route::middleware(["auth","role:agent"])->group(function() {

Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
// Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
    

});// Middleware Agent

Route::get('/admin/login', [AdminController::class,"admin_login"])->name('admin.login');




