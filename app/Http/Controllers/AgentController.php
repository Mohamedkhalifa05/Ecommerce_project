<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    //
    public function Agent_Dashboard(){


        return view("agent.index");

    }// End Method


    public function agent_login() {

 return view("agent.agent_login");

    }//End Method

  public function Agent_register(Request $request) {

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => 'agent',
        'status' => 'inactive',
        'password' => Hash::make($request->password),
    ]);
    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::AGENT);

  }//End Method

  public function Agent_logout(Request $request) {

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    // return redirect('/admin/login');
    $notification = array(
      'message' => 'Agent Logout Successfully',
      'alert-type' => 'success'
  ); 

  return redirect('/agent/login')->with($notification);

  }//End Method

  public function Agent_profile() {

    $id = Auth::user()->id;

    $profileData = User::find($id);
 
    return view("agent.agent_profile_view",compact("profileData"));

  }//End Method

  public function agent_profile_store(Request $request){


    $id = Auth::user()->id;
    $data = User::findOrfail($id);
    $data->username = $request->username;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->address = $request->address;

    if ($request->file('photo')) {
      $img = $request->file('photo');
      unlink(public_path($data->photo));
      $make_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
      $img->move("upload/agent_images/",$make_name);
      $path= "upload/agent_images/".$make_name;
      $data['photo'] = $path ;
    }

    $data->save();
   
   $notification = array(
    "message" => 'Agent Profile Updated Successfully',
    "alert-type" => "success"
   );


   return redirect()->back()->with($notification);
   

  }//End Method

  public function agentChangePassword() {

    $id = Auth::user()->id;
    $profileData = User::find($id);

    return view('agent.agentChangePassword',compact('profileData'));

  }//end Method

  public function agent_update_password(Request $request){
    

    //validation

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
