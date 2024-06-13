<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PropertType;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\State;
use App\Models\User;
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


    public function AgentDetails($id) {

    $agent = User::findOrFail($id);
    $property = Property::where("agent_id",$id)->get();
    $featured = Property::where("featured","1")->limit(3)->get();
    $propertyRend = Property::where("property_status","rent")->get();
    $propertybuy = Property::where("property_status","buy")->get();

    
    return view("frontend.agent.agent_details",compact('agent','property','featured',"propertyRend","propertybuy"));

    }//End Method

     public function AgentDetailsMessage(Request $request) {
        
        $aid = $request->agent_id;

        if (Auth::check()) {

            PropertyMessage::insert([
                "user_id" => Auth::user()->id,
                "agent_id" => $aid,
                
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

     }//end Method
     public function RentProperty() {

     $property = Property::where('status',1)->where("property_status","rent")
     ->paginate(3);

     return view("frontend.property.rent_property",compact('property'));

     }//End Method
     public function BuyProperty() {

        $property = Property::where('status',1)->where("property_status","buy")->paginate(3);
   
        return view("frontend.property.buy_property",compact('property'));
   
        }//End Method

        public function PropertyType($id) {
       $property = Property::where("status", "1")->where("ptype_id",$id)->get();
       $pbread = PropertType::where("id",$id)->first();

       return view("frontend.property.property_type",compact("property",'pbread'));

        }//End Method


        public function State_Details($id){

         $state = State::where("id",$id)->first();

       $property = Property::where("status",1)->where("state",$id)->get();
       return view('frontend.property.property_state',compact('property',"state"));

        }//End Method
        public function BuyPropertySearch(Request $request){

            $request->validate(["search" => "required"],[
                "search.required" => "You Must Fill this field",
            ]);
            $sstate = $request->state;
            $stype = $request->ptype_id;
            $item = $request->search;

        $property = Property::where("property_name","like","%".$item."%")->
               where("property_status","buy")->with("type","pstate")->
               whereHas("pstate",function($q) use ($sstate) {
                 $q->where("state_name","like","%".$sstate."%");
               })
               -> whereHas("type",function($q) use ($stype) {
                $q->where("type_name","like","%".$stype."%");
              })->get();
              return view('frontend.property.property_search',compact('property'));
        }//End Method 

        public function RentPropertySearch(Request $request){
            $request->validate(["search" => "required"],[
                "search.required" => "You Must Fill this field",
            ]);
            $sstate = $request->state;
            $stype = $request->ptype_id;
            $item = $request->search;
            $property = Property::where("property_name","like","%".$item."%")->
               where("property_status","rent")->with("type","pstate")->
               whereHas("pstate",function($q) use ($sstate) {
                 $q->where("state_name","like","%".$sstate."%");
               })
               -> whereHas("type",function($q) use ($stype) {
                $q->where("type_name","like","%".$stype."%");
              })->get();
              return view('frontend.property.property_search',compact('property'));

        }//End Method 

        public function AllPropertySearch(Request $request){
            $sstate = $request->state;
            $stype = $request->ptype_id;
            $property_status= $request->property_status;
            $bedrooms = $request->bedrooms;
            $bathrooms = $request->bathrooms;


            $property = Property::where("status","1")->where("bedrooms",$bedrooms)->
            where("bathrooms","like","%".$bathrooms."%")->
            where("property_status",$property_status)->with("type","pstate")->
               whereHas("pstate",function($q) use ($sstate) {
                 $q->where("state_name","like","%".$sstate."%");
               })
               -> whereHas("type",function($q) use ($stype) {
                $q->where("type_name","like","%".$stype."%");
              })->get();
              return view('frontend.property.property_search',compact('property'));

          
        }//End Method 
    
}
