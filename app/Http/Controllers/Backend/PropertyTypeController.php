<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //


    public function All_Types() {
        

        $types = PropertType::latest()->get(); 

        return view("backend.type.all_type",compact("types"));
    }//End Method

    public function add_Type(){

      return  view("backend.type.add_type");
        
    }//End Method

    public function TypeStore(Request $request) {
        //validation

        $request->validate([
            "type_name" => "required|unique:propert_types,type_name|max:200",
            "type_icon" => "required"
        ]);

        // Add Type Property

        $type = new PropertType() ;

        $type->type_name = $request->type_name;
        $type->type_icon = $request->type_icon;

        $type->save();

        $notification = array(
            "message" => "Add New Property Type Successfully",
            "alert-type" => "success"
        ) ;


        return redirect()->route("all.types")->with($notification);



    }//End Method

    public function Edit_type($id) {

        $type = PropertType::find($id);

        return view('backend.type.edit_type',compact("type"));

    }//End Method

    public function Update_type($id ,Request $request) {

     // validation 

     $request->validate([
        "type_name" => "required|max:200",
        "type_icon" => "required"
     ]);

     // Update Property Type
        $type = PropertType::find($id);

       $type->update([
        "type_name" => $request->type_name,
        "type_icon" => $request->type_icon
       ]);

       $notification = array(
        "message" => "Property Type Updated Successfully",
        "alert-type" => "success"
       );
        
       return redirect()->route("all.types")->with($notification);
    }//End Method

    public function Delete_type($id){

       PropertType::find($id)->delete();
       
       $notification = array(
        "message" => "Property Type deleted Successfully",
        "alert-type" => "warning"
       );
       return redirect()->route("all.types")->with($notification);

    }//End Method


    ////////////All Amenities Methods

    public function All_Amenities() {


        $amenities = Amenities::latest()->get();

        return view("backend.Amenities.all_amenities",compact("amenities"));

    }//End Method

    public function Add_amenitie() {

        return view("backend.Amenities.add_amenitie");

    }//End Method

    public function Store_amenitie(Request $request) {

        //validation

        $request->validate([
            "amenitie_name" => "required|max:200|unique:amenities,amenitie_name"
        ]);

        ///Store Data amenitie

        $amenitie = new Amenities();

        $amenitie->amenitie_name = $request->amenitie_name;

        $amenitie->save();

        $notification = array(
            "message" => "New Amenitie inserted Successfully",
            "alert-type" => "success"
        ) ;

        return redirect()->route("all.Amenities")->with($notification);

    }//End Method

    public function Edit_amenitie($id){

        $amenitie = Amenities::find($id);

        return view("backend.Amenities.edit_amenitie",compact("amenitie"));

    }//End Method

    public function Update_amenitie($id,Request $request){


       

        Amenities::find($id)->update([
            "amenitie_name" => $request->amenitie_name
        ]);

        
       $notification = array(
        "message" => "Amenitie Updated Successfully",
        "alert-type" => "success"
       );
        
       return redirect()->route("all.Amenities")->with($notification);

    }//End Method

    public function Delete_amenitie($id) {

        Amenities::find($id)->delete();
        $notification = array(
            "message" => "Amenitie Delete Successfully",
            "alert-type" => "warning"
           );
        return redirect()->route("all.Amenities")->with($notification);

    }//End Method




}
