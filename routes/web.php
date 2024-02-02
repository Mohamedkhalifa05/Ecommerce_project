<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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

    //Route Property

    Route::controller(PropertyController::class)->group(function() {

        Route::get("all/Properties","All_property")->name("all.Properties") ;
        Route::get("add/Property","Add_Property")->name("add.Property") ;
        Route::post("store/Property","Store_Property")->name("store.Property");
        Route::get("edit/property/{id}" , "Edit_property")->name("edit.property");
        Route::post("update/Property","update_Property")->name("update.Property");
        Route::post("update/Property/thambnail","update_Prothambnail")->name("update.Property.thambnail");
        Route::post("update/Property/multi_image","update_Property_Multi_image")->name("update.Property.multi_image");
        Route::get("delete/Property/multImage/{id}" , "delete_Property_MultImage")->name("delete.Property.multi_image");
        Route::post("store/new/multi_image","store_new_multi_image")->name("store.new.multi_image");
        Route::post('update/Property/facility', 'update_Property_Facility')->name('update.Property.facility');

        Route::get('details/property/{id}', 'details_Property')->name('details.property');
        Route::post('inactive/Property', 'inactive_Property')->name('inactive.Property');
        Route::post('active/Property', 'active_Property')->name('active.Property');

        
        
        Route::get("delete/property/{id}","Delete_property")->name("delete.property");

    });

    

});// Middleware Admin  Property
Route::middleware(["auth","role:agent"])->group(function() {

Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
// Route::get('/agent/dashboard', [AgentController::class,"Agent_Dashboard"])->name('Agent_Dashboard');
    

});// Middleware Agent
Route::get('/agent/login', [AgentController::class,"agent_login"])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class,"agent_register"])->name('agent.register')->middleware(RedirectIfAuthenticated::class);



// User Frontend All Route 
Route::get('/', [UserController::class, 'Index']);

Route::get('/admin/login', [AdminController::class,"admin_login"])->name('admin.login')->middleware(RedirectIfAuthenticated::class);




