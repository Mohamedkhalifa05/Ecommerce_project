<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\FrontEnd\CompareController;
use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\FrontEnd\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\PropertyMessage;

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


    Route::controller(WishlistController::class)->group(function () {
        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property','GetWishlistProperty');
        Route::get('/wishlist-remove/{id}','wishlistRemove');
    });

    // all Route To Compare

    Route::controller(CompareController::class)->group(function () {
        
        Route::get('/user/comparelist', 'UserComparelist')->name('user.compare');
        Route::get('/get-compare-property','GetComparelistProperty');
        Route::get('/compare-remove/{id}','ComparelistRemove');

    });
   
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
        Route::get('admin/package/history', 'AdminPackageHistory')->name('admin.package.history');
        Route::get('admin/package/invoice/{id}', 'adminPackageInvoice')->name('admin.package.invoice');
        Route::get('admin/property/message', 'AdminPropertyMessage')->name('admin.property.message');
        Route::get('admin/message/details/{id}', 'AdminMessageDetails')->name('admin.message.details');
    });

    //// Agents Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/All/agents', 'All_Agent')->name('all.agents');
        Route::get('add/agent', 'add_Agent')->name('add.agent');
        Route::post('store.agent', 'store_Agent')->name('store.agent');
        Route::get('agent/edit/{id}', 'agent_Edit')->name('agent.edit');
        Route::post('update/agent', 'update_Agent')->name('update.agent');
        Route::get('agent/delete/{id}', 'agent_Delete')->name('agent.delete');
        Route::get('/changeStatus', 'changeStatus');
     
    });

    

});// Middleware Admin  Property
Route::middleware(["auth","role:agent"])->group(function() {

    Route::controller(AgentController::class)->group(function () {

        Route::get('/agent/dashboard', "Agent_Dashboard")->name('Agent_Dashboard');
        Route::get('/agent/logout', "Agent_logout")->name('agent.logout');
        Route::get('/agent/profile', "Agent_profile")->name('agent.profile');
        Route::post('agent/profile/store', 'agent_profile_store')->name('agent.profile.store');
        Route::get("agent/ChangePassword","agentChangePassword")->name("agent.change.password");
        Route::post('agent/update/password',"agent_update_password")->name('agent.update.password');
        
    });

   


});// Middleware Agent
Route::middleware(["auth","role:agent"])->group(function(){
     ///Agent All Property 
     Route::controller(AgentPropertyController::class)->group(function () {

        Route::get('agent/all/properties', "agentAllProperties")->name('agentAllProperties');
        Route::get('agent/add/property', 'agentAddProperty')->name('agent.add.property');
       Route::post('agent/store/property', 'agentStoreProperty')->name('agent.store.property');
       Route::get('agent/edit/property/{id}', 'agentEditProperty')->name("agent.edit.property");
       Route::post('agent.update.Property', 'agent_update_Property')->name('agent.update.Property');
       Route::post('agent/update/Property/thambnail', 'updateAgentPropertyThambnail')->name('agent.update.Property.thambnail');
       Route::post('agent/update/Property/multi_image', 'updateAgentPropertyMulti_image')->name('agent.update.Property.multi_image');
       Route::get('agent/delete/Property/multi_image/{id}', 'deletePropertyMultImageAgent')->name('agent.delete.Property.multi_image');
       Route::post('agent/store/new/multi_image', 'storeNewMultImageAgent')->name('agent.store.new.multi_image');
       Route::post('agent/update/Property/facility', 'updatePropertyFacilityAgent')->name('agent.update.Property.facility');
       Route::get('agent/details/property/{id}', 'agentDetailsProperty')->name('agent.details.property');
       Route::get('agent/delete/property/{id}', 'AgentDeletesProperty')->name('agent.delete.property');
       Route::post('agent/active/property', 'Agentactive_Property')->name('agent.active.property');
       Route::post('agent/inactive/property', 'Agentinactive_Property')->name('agent.inactive.property');
    });
    ///End Agent All Property 


    /// Agent Buy Package
    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('buy/package', 'BuyPackage')->name("buy.package");
        Route::get('business/plan', 'BusinessPlan')->name('business.plan');
        Route::post('store/business/plan', 'storeBusinessPlan')->name('store.business.plan');
        Route::get('professional/plan', 'professionalPlan')->name('professional.plan');
        Route::post('store/professional/plan', 'storeProfessionalPlan')->name('store.professional.plan');
        Route::get('package/history', 'packageHistory')->name('package.history');
       Route::get('agent/package/invoice/{id}', 'agentPackageInvoice')->name('agent.package.invoice');
       Route::get('agent/property/message','agentPropertyMessage')->name('agent.property.message');
       Route::get('agent/message/details/{id}', 'AgentDessageDetails')->name('agent.message.details');

    });
    /// End Agent Buy Package

   

} );
Route::controller(AgentController::class)->group(function () {


    Route::get('/agent/login', "agent_login")->name('agent.login')->middleware(RedirectIfAuthenticated::class);

    Route::post('/agent/register', "Agent_register")->name('agent.register');

});//End Agent Route





// User Frontend All Route 
Route::get('/', [UserController::class, 'Index']);

//******* Fronted End Route*** */

Route::controller(IndexController::class)->group(function () {
    Route::get('property/details/{id}/{slug}', 'propertyDetails');
   Route::post('property/message', 'PropertyMessage')->name('property.message');
});

Route::controller(WishlistController::class)->group(function () {
    Route::post('/add-to-wishList/{id}', 'AddWishlist');
    
});
Route::controller(CompareController::class)->group(function () {
   
    Route::post('/add-to-compare/{id}', 'AddCompare');
});


//******* Fronted End Route*** */

Route::get('/admin/login', [AdminController::class,"admin_login"])->name('admin.login')->middleware(RedirectIfAuthenticated::class);



