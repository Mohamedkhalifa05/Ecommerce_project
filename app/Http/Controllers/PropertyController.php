<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PHPUnit\Framework\Constraint\Count;

class PropertyController extends Controller
{
    //

    public function All_property() {

        $properties = Property::latest()->get();

        return view("backend.property.all_property",compact("properties"));

    }//End Method
    public function Add_Property() {

            $propertytype = PropertType::latest()->get();
            // $amenities = DB::table('amenities')->latest()->get();
            $amenities = Amenities::latest()->get();
            $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
            return view('backend.property.add_property',compact('propertytype','amenities','activeAgent'));

    }//End Method

    public function Store_Property(Request $request) {

        $p_code = IdGenerator::generate(["table"=> "properties","field" => "property_code","length"=>5,"prefix" => "Pc"]);

     $ameni = $request->amenities_id;
     $amenities = implode(",",$ameni);
    //  dd($amenities);

        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save("upload/property/thambnail/".$name_gen);
        $save_url = "upload/property/thambnail/".$name_gen;
        $property_id = Property::insertGetId([
            "ptype_id" => $request->ptype_id,
            "amenities_id" => $amenities,
            "property_name" => $request->property_name,
            "property_slug" => strtolower(str_replace(" ","-",$request->property_name)),
            "property_code" => $p_code,
            "property_status" => $request->property_status,
            "lowest_price" => $request->lowest_price,
            "max_price" => $request->max_price,
            "short_descp" => $request->Short_des,
            "long_descp" => $request->long_descp,
            "bedrooms" => $request->bedrooms,

            "bathrooms" => $request->bathrooms,
            "garage" => $request->garage,
            "garage_size" => $request->garage_size,
            "property_size" => $request->property_size,
            "property_video" => $request->property_video,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "postal_code" => $request->postal_code,

            "neighborhood" => $request->neighborhood,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "featured" => $request->featured,
            "hot" => $request->hot,
            "agent_id" => $request->agent_id,
            "status" => 1,
            "property_thambnail" => $save_url,
            "created_at" => Carbon::now(),
            
        ]);

        /// Upload multiple Image

        $images =  $request->file('multi_img');

        foreach ($images as $img) {
          $img_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
          Image::make($img)->resize(770,520)->save("upload/property/multi_img".$img_name);
          $Image_multi = "upload/property/multi_img".$img_name;

          MultiImage::insert([
            "property_id" => $property_id,
            "photo_name" => $Image_multi,
            "created_at" => Carbon::now()
          ]);
        }//End Foreach

        /// Upload multiple Image

        ///Facilities Here Inserted 

        $facilities = Count($request->facility_name);
        if ($facilities != Null) {
            for ($i=0; $i < $facilities ; $i++) { 
                Facility::insert([
                    "property_id" => $property_id,
                    "facility_name" => $request->facility_name[$i],
                    'distance' => $request->distance[$i],
                    
                ]);
            }

           
        }
        $notification = array(
            "message" => 'Property Inserted Successufully',
            "alert-type" => "success"
        );

        return redirect()->route("all.Properties")->with($notification);

        ///Facilities End

    }//End Method
}
