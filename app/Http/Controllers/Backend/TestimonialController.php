<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    //


    public function All_Testimonals(Request $request){


        $testimonials = Testimonial::latest()->paginate(6); 

        return view("backend.testimonial.all_testimonials",compact("testimonials"));
      
    }//End Method 

    public function add_Testimonals() {
        return  view("backend.testimonial.add_testimonial");
     }//End Method

     public function Testimonial_Store(Request $request) {
        //validation

        $request->validate([
            "name" => "required|unique:testimonials,name|max:200",
            "position" => "required",
            "message" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg"
        ],[
           "name.required" => "You must add Testimonial Name" ,
           "name.unique" => "This  Testimonial Name Is Already Exist !!",
           "name.max" => "The Testimonial Name must less than 200 Character" ,
           "position.required" => "You must add Position" ,
           "message.required" => "You must add message" ,
           "image.required" =>"You must add Image",
           "image.image" =>"You must add  Image",
           "image.mimes" =>"Image must be jpeg Or png Or jpg Extensions ", 
            
        ]);

        // Add State
        
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(100,100)->save("upload/testimonial/".$name_gen);
        $save_url = "upload/testimonial/".$name_gen;

        $testimonial = new Testimonial() ;

        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->message = $request->message;
        $testimonial->image = $save_url;
        $testimonial->created_at = Carbon::now();

        $testimonial->save();

        $notification = array(
            "message" => "Add New Testimonial Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->route("all.testimonals")->with($notification);



    }//End Method


    public function Edit_Testimonial($id) {

        $testimonial = Testimonial::findOrFail($id);
        return  view("backend.testimonial.edit_testimonial",compact("testimonial"));

    }//End Method

    public function Update_Testimonial(Request $request) {

        $testimonial_id = $request->testimonial_id;
        $testimonial = Testimonial::findOrFail($testimonial_id);
        if ($request->file("image")){


            //validation

        $request->validate([
            "name" => "required|max:200",
            "position" => "required",
            "message" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg"
        ],[
           "name.required" => "You must add  Name" ,
           "name.max" => "The Name must less than 200 Character" ,
           "position.required" => "You must add  position" ,
           "message.required" => "You must add  message" ,
           "image.required" =>"You must add The Image",
           "image.image" =>"You must add  Image",
           "image.mimes" =>"Image must be jpeg Or png Or jpg Extensions ", 
            
        ]);

        //delete old image
        unlink(public_path($testimonial->image));
        // update State
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(100,100)->save("upload/testimonial/".$name_gen);
        $save_url = "upload/testimonial/".$name_gen;

        Testimonial::findOrFail($testimonial_id)->update([
            "name" => $request->name,
            "position" => $request->position,
            "message" => $request->message,
            "image" => $save_url,
            "updated_at" => Carbon::now()
        ]);

        $notification = array(
            "message" => "updated  Testimonial  Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->route("all.testimonals")->with($notification);

           
        } else {

                //validation

        $request->validate([
            "name" => "required|max:200",
            "position" => "required",
            "message" => "required",  
        ],[
            "name.required" => "You must add  Name" ,
            "name.max" => "The Name must less than 200 Character" ,
            "position.required" => "You must add  position" ,
            "message.required" => "You must add  message" ,
        ]);


            Testimonial::findOrFail($testimonial_id)->update([
                "name" => $request->name,
                "position" => $request->position,
                "message" => $request->message,
                "updated_at" => Carbon::now()
            ]);
    
            $notification = array(
                "message" => "updated  Testimonial  Successfully",
                "alert-type" => "success"
            ) ;
    
    
            return redirect()->route("all.testimonals")->with($notification);
           
        }
        
    }// End Method
    public function Delete_testimonial($id) {
  
        $testimonial = Testimonial::findOrFail($id);
        $img = $testimonial->image;
        unlink($img);

        $testimonial->delete();
        
        $notification = array(
            "message" => "this Testimonial  deleted Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->back()->with($notification);
       
    


    }//end Method

    
}
