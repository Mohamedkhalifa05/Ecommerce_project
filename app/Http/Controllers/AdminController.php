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

        // return redirect('/admin/login');
        $notification = array(
          'message' => 'Admin Logout Successfully',
          'alert-type' => 'success'
      ); 

      return redirect('/admin/login')->with($notification);
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
    $pathurl = "upload/admin_images/".$filename;
    $data["photo"] = $pathurl;
    
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


  ///////Agents Routes ///////////////////

  public function All_Agent() {

    $all_agents = User::where("role","agent")->get();
    return view("backend.agentuser.all_agent",compact('all_agents'));

  }///End Method

  public function add_Agent() {

    return view('backend.agentuser.add_agent');

  }//end Method 

  public function store_Agent(Request $request) {

    $agent = new User();
    $agent->name = $request->name;
    $agent->username = $request->username;
    $agent->email = $request->email;
    $agent->password = Hash::make($request->password);
    $agent->phone = $request->phone;
    $agent->address = $request->address;
    $agent->status = $request->status;
    $agent->role = 'agent' ;
    if ($request->file('photo')) {
      $img = $request->file('photo');
      
      $make_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
      $img->move("upload/agent_images/",$make_name);
      $path= "upload/agent_images/".$make_name;
      $agent['photo'] = $path ;
    }
    
    $agent->save();
    $notification = array(
      "message" => "New Agent Added Successufully",
      "alert-type"=>"success"
    );

    return redirect()->route('all.agents')->with($notification);

  }//End Method

  public function agent_Edit($id) {
    
    $agent = User::findOrFail($id);
    // return $agent;
    return view('backend.agentuser.edit_agent',compact('agent'));
  }//End Method

  public function update_Agent(Request $request) {

    $id = $request->id ;

    $agent = User::findOrFail($id);
    

   $agent->name = $request->name;
   $agent->username = $request->username;
   $agent->email = $request->email;
   $agent->password = Hash::make($request->password);
   $agent->phone = $request->phone;
   $agent->address = $request->address;
   $agent->role = 'agent';
   $agent->status = $request->status;
   if ($request->file('photo')) {
    $img = $request->file('photo');
    if ($agent->photo == Null) {
      $make_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
      $img->move("upload/agent_images/",$make_name);
      $path= "upload/agent_images/".$make_name;
      $agent['photo'] = $path ;
      
    } else {
    unlink(public_path($agent->photo));
    $make_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
    $img->move("upload/agent_images/",$make_name);
    $path= "upload/agent_images/".$make_name;
    $agent['photo'] = $path ;
    }
    
    
  }
  
  $agent->save();
  $notification = array(
    "message" => " Agent Updated Successufully",
    "alert-type"=>"success"
  );

  return redirect()->route('all.agents')->with($notification);


  }//End Method

  public function agent_Delete($id) {

    User::findOrFail($id)->delete();

    $notification = array(
      "message" => " Agent Deleted Successufully",
      "alert-type"=>"success"
    );
  
    return redirect()->route('all.agents')->with($notification);

  }//End Method

  public function changeStatus(Request $request){

    $user = User::find($request->user_id);
    $user->status = $request->status;
    $user->save();

    return response()->json(['success'=>'Status Change Successfully']);

  }// End Method 

}
