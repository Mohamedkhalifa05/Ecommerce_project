<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile'); 
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout'); 
    
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password'); 

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
   
});




require __DIR__.'/auth.php';

Route::middleware(["auth","role:admin"])->group(function() {

    Route::get('/admin/dashboard', [AdminController::class,"Admin_Dashboard"])->name('Admin_Dashboard');

    Route::get('/admin/logout', [AdminController::class,"admin_logout"])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class,"admin_profile"])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class,"admin_profile_store"])->name('admin.profile.store');

    Route::get("admin/ChangePassword",[AdminController::class,"adminChangePassword"])->name("admin.change.password");

    Route::post('admin/update/password', [AdminController::class,"admin_update_password"])->name('admin.update.password');

    

});// Middleware Admin 

Route::middleware(["auth","role:admin"])->group(function() {

   

    Route::controller(PropertyTypeController::class)->group(function() {

        Route::get("all/types","All_Types")->name("all.types") ;
        Route::get("add/type","add_Type")->name("add.type") ;
        Route::post("type/store","TypeStore")->name("store.type");
        Route::get("edit/type/{id}" , "Edit_type")->name("edit.type");
        Route::post("update/type/{id}","Update_type")->name("update.type");
        Route::get("delete/type/{id}","Delete_type")->name("delete.type");

    });

    ///// Route Amenities
    Route::controller(PropertyTypeController::class)->group(function() {

        Route::get("all/Amenities","All_Amenities")->name("all.Amenities") ;
        Route::get("add/amenitie","Add_amenitie")->name("add.amenitie") ;
        Route::post("store/amenitie","Store_amenitie")->name("store.amenitie");
        Route::get("edit/amenitie/{id}" , "Edit_amenitie")->name("edit.amenitie");
        Route::post("update/amenitie/{id}","Update_amenitie")->name("update.amenitie");
        Route::get("delete/amenitie/{id}","Delete_amenitie")->name("delete.amenitie");

    });

    

});// Middleware Admin  Property
Route::middleware(["auth","role:agent"])->group(function() {

Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
// Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
    

});// Middleware Agent

// User Frontend All Route 
Route::get('/', [UserController::class, 'Index']);

Route::get('/admin/login', [AdminController::class,"admin_login"])->name('admin.login');




