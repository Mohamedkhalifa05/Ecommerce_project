<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function Admin_Dashboard(){

      $id = Auth::user()->id;

      $profileData = User::find($id);
        return view("admin.index",compact('profileData'));

    }// End Method


    public function admin_logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//End Method

    public function admin_login(Request $request)
    {
 

        return view("admin.login");
    }//End Method

  public function admin_profile() {

   $id = Auth::user()->id;

   $profileData = User::find($id);

    return view("admin.admin_profile_view",compact("profileData"));

  }//End Method

  public function admin_profile_store(Request $request) {

   $id = Auth::user()->id;

   $data = User::findOrFail($id);

   $data->username = $request->username;
   $data->name = $request->name;
   $data->email = $request->email;
  //  $data->password = Hash::make($request->password);

   $data->address = $request->address;
   $data->phone = $request->phone;
   

   if ($request->file("photo")) {

    $file = $request->file("photo");
    @unlink(public_path('upload/admin_images/').$data->photo);
    $filename = ($request->name).$file->getClientOriginalName();
    $file->move(public_path("upload/admin_images/"),$filename);
    $data["photo"] = $filename;
    
   }

   $data->save();

   $notification = array(
    "message" => "Admin Profile Update Successfully",
    "alert-type" => "success"
   ) ;
return redirect()->back()->with($notification);

  }//End Method

  public function adminChangePassword() {

    $id = Auth::user()->id ;
    $profileData = User::find($id) ;

    return view("admin.adminChangePassword",compact("profileData"));

  }//End Method

  public function admin_update_password(Request $request) {

    ///validation

    $request->validate([
      "old_password" => "required",
      "new_password" => "required|confirmed"
    ]);

   //match with old Password

   if (!Hash::check($request->old_password, auth()->user()->password)) {
   
    $notification = array(
      "message" => "Old Password Does Not Match",
      "alert-type" => "error"
    ) ;

    return redirect()->back()->with($notification);
   }

   User::whereId(Auth()->user()->id)->update([
     'password' => Hash::make($request->new_password)
   ]);

   $notification = array(
    "message" => "Change Password Successfully",
    "alert-type" => "success"
  ) ;

  return redirect()->back()->with($notification);

  }//End Method

}
