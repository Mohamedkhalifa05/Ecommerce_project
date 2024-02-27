<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //

    public function propertyDetails($id,$slug) {

        $property = Property::findOrFail($id);

        $amenities = $property->amenities_id;

        $property_amen = explode(',',$amenities);

        $facility = Facility::where('property_id',$id)->get();

       $multiImage = MultiImage::where("property_id",$id)->get();

       $ptype = $property->ptype_id;
       
       $related_properties = Property::where('ptype_id',$ptype)
       ->where("id",'!=' ,$id)->orderBy('id','DESC')->limit(3)->get();
    //    var_dump($related_properties);
        return view('frontend.property.property_details',compact('property','multiImage','property_amen','facility','related_properties'));

    }//End Method

    public function PropertyMessage(Request $request) {
    

        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {

            PropertyMessage::insert([
                "user_id" => Auth::user()->id,
                "agent_id" => $aid,
                "property_id" => $pid,
                "msg_name" => $request->msg_name,
                "msg_email" => $request->msg_email,
                "msg_phone" => $request->msg_phone,
                "message" => $request->message,
                "created_at" => Carbon::now()
            ]);

            $notification = array(
                "message" => "Your Message Sent Successufully",
                "alert-type" => 'success'
            );

            return redirect()->back()->with($notification);
            
        } else {
            $notification = array(
                "message" => "Please First Login Your Account",
                "alert-type" => 'error'
            );

            return redirect()->back()->with($notification);

            
        }
        

    }//End Method
}
