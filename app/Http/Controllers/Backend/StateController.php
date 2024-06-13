<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class StateController extends Controller
{
    //


     public function All_States() {

        $states = State::latest()->paginate(6); 

        return view("backend.state.all_state",compact("states"));

     }//End Method
     public function add_State() {
        return  view("backend.state.add_state");
     }//End Method
     public function State_Store(Request $request) {
        //validation

        $request->validate([
            "state_name" => "required|unique:states,state_name|max:200",
            "state_image" => "required|image|mimes:jpeg,png,jpg"
        ],[
           "state_name.required" => "You must add state Name" ,
           "state_name.unique" => "This  state Name Is Already Exist !!",
           "state_name.max" => "The State Name must less than 200 Character" ,
           "state_image.required" =>"You must add The State Image",
           "state_image.image" =>"You must add  Image",
           "state_image.mimes" =>"Image must be jpeg Or png Or jpg Extensions ", 
            
        ]);

        // Add State
        
        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(370,275)->save("upload/state/".$name_gen);
        $save_url = "upload/state/".$name_gen;

        $state = new State() ;

        $state->state_name = $request->state_name;
        $state->state_image = $save_url;
        $state->created_at = Carbon::now();

        $state->save();

        $notification = array(
            "message" => "Add New State Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->route("all.state")->with($notification);



    }//End Method


    public function Edit_state($id) {

        $state = State::findOrFail($id);
        return  view("backend.state.edit_state",compact("state"));

    }//End Method

    public function Update_state(Request $request) {

        $state_id = $request->state_id;
        $state = State::findOrFail($state_id);
        if ($request->file("state_image")){


            //validation

        $request->validate([
            "state_name" => "required|max:200",
            "state_image" => "required|image|mimes:jpeg,png,jpg"
        ],[
           "state_name.required" => "You must add state Name" ,
           "state_name.max" => "The State Name must less than 200 Character" ,
           "state_image.required" =>"You must add The State Image",
           "state_image.image" =>"You must add  Image",
           "state_image.mimes" =>"Image must be jpeg Or png Or jpg Extensions ", 
            
        ]);

        //delete old image
        unlink(public_path($state->state_image));
        // update State
        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(370,275)->save("upload/state/".$name_gen);
        $save_url = "upload/state/".$name_gen;

        State::findOrFail($state_id)->update([
            "state_name" => $request->state_name,
            "state_image" => $save_url,
            "updated_at" => Carbon::now()
        ]);

        $notification = array(
            "message" => "updated  State  Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->route("all.state")->with($notification);

           
        } else {

                //validation

        $request->validate([
            "state_name" => "required|max:200",  
        ],[
           "state_name.required" => "You must add state Name" ,
           "state_name.max" => "The State Name must less than 200 Character" , 
        ]);


            State::findOrFail($state_id)->update([
                "state_name" => $request->state_name,
                "updated_at" => Carbon::now()
            ]);
    
            $notification = array(
                "message" => "updated  State  Successfully",
                "alert-type" => "success"
            ) ;
    
    
            return redirect()->route("all.state")->with($notification);
           
        }
        
    }// End Method

    public function Delete_state($id) {
  
        $state = State::findOrFail($id);
        $img = $state->state_image;
        unlink($img);

        $state->delete();
        
        $notification = array(
            "message" => "this State  deleted Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->back()->with($notification);
       
    


    }//end Method

     
}
