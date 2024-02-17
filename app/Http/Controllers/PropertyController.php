<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertType;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;
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

        if($request->agent_id == null) {
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
              
                "agent_id" => Auth::user()->id,
                "status" => 1,
                "property_thambnail" => $save_url,
                "created_at" => Carbon::now(),
                
            ]);
            
        } else {
            
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
    }

        /// Upload multiple Image

        $images =  $request->file('multi_img');

        foreach ($images as $img) {
          $img_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
          Image::make($img)->resize(770,520)->save("upload/property/multi_img/".$img_name);
          $Image_multi = "upload/property/multi_img/".$img_name;

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

    public function Edit_property($id) {

        $facilities = Facility::where("property_id",$id)->get();

       $property = Property::find($id);

       $type = $property->amenities_id;
       $property_ameni = explode(",",$type);
       $PropertType = PropertType::latest()->get();
       $multi_image = MultiImage::where("property_id",$id)->get();
       $amenities = Amenities::latest()->get();
       $activeAgent = User::where("role","agent")->where("status","active")->latest()->get();
           

       return view("backend.property.edit_property",compact("property","facilities","PropertType","amenities","activeAgent","property_ameni","multi_image"));
         
    }//End Method

    public function update_Property(Request $request) {

        
       
    // dd(Auth::user()->id);

        $ameni = $request->amenities_id;
        $amenities = implode(",",$ameni);

        $property_id = $request->id;

        if ($request->agent_id == "admin") {
            Property::findOrFail($property_id)->update([
                "ptype_id" => $request->ptype_id,
                "amenities_id" => $amenities,
                "property_name" => $request->property_name,
                "property_slug" => strtolower(str_replace(" ","-",$request->property_name)),
                // "property_code" => $p_code,
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
                "agent_id" => Auth::user()->id,
                
                "updated_at" => Carbon::now(),
            ]);
           
        } else {
            Property::findOrFail($property_id)->update([
                "ptype_id" => $request->ptype_id,
                "amenities_id" => $amenities,
                "property_name" => $request->property_name,
                "property_slug" => strtolower(str_replace(" ","-",$request->property_name)),
                // "property_code" => $p_code,
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
                // "status" => 1,
                // "property_thambnail" => $save_url,
                "updated_at" => Carbon::now(),
            ]);
            
        }
        

        

        $notification = array(
            "message" => 'Property Updated Successufully',
            "alert-type" => "success"
        );

        return redirect()->route("all.Properties")->with($notification);


    }//End Method

    public function update_Prothambnail(Request $request) {


        $id = $request->id;
        $old_img = $request->old_img;

        $image = $request->file("property_thambnail");

        $gen_name = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save("upload/property/thambnail/".$gen_name);
        $save_url = "upload/property/thambnail/".$gen_name;

        if (file_exists($old_img)) {
          unlink($old_img)  ;
        }

        Property::findOrFail($id)->update([
            "property_thambnail" => $save_url,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            "message" => 'Property Thambnail Image Updated Successufully',
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }//End Method

    
   public function update_Property_Multi_image(Request $request) {
 if($request->file("multi_image") == null ) {
    $notification = array(
        "message" => 'Property Multiple Image Not Added',
        "alert-type" => "warning"
       );
 return redirect()->back()->with($notification);
 }else {
   $imgs = $request->multi_image;

   foreach ($imgs as $id => $img) {
    $imgDel = MultiImage::findOrFail($id);
    unlink($imgDel->photo_name);
    $make_name = hexdec(uniqid()).".".$img->getClientOriginalExtension();
    Image::make($img)->resize(770,520)->save("upload/property/multi_img/".$make_name);

    $url_path = "upload/property/multi_img/".$make_name;

    MultiImage::where("id",$id)->update([
        "photo_name" => $url_path,
        "updated_at"=>Carbon::now()
    ]);
  
   }///end Foreach
       $notification = array(
        "message" => 'Property Multiple Image Updated Successufully',
        "alert-type" => "success"
       );

       return redirect()->back()->with($notification);
    }
   }//End Method
   
   public function delete_Property_MultImage($id) {
   
    $old_img = MultiImage::findOrFail($id);
    unlink($old_img->photo_name);
    MultiImage::findOrfail($id)->delete();
    $notification = array(
        "message" => 'Property Multiple Image Deleted Successufully',
        "alert-type" => "warning"
       );

       return redirect()->back()->with($notification);
    
   }//End Method

   public function store_new_multi_image(Request $request){

   

    if($request->file("multi_img") == null) {
        $notification = array(
            "message" => 'Not Added Image',
            "alert-type" => "warning"
           );
    
           return redirect()->back()->with($notification);
        
    } else {
        $new_image = $request->img_id;
        $image = $request->file("multi_img");
        $make_name = hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(770,520)->save("upload/property/multi_img/".$make_name);
        $url_path = "upload/property/multi_img/".$make_name;
        MultiImage::insert([
            "property_id"=>$new_image ,
            "photo_name" => $url_path ,
            "created_at" =>Carbon::now()
        ]);
        $notification = array(
            "message" => 'New Image Inserted Successufully',
            "alert-type" => "success"
           );
    
           return redirect()->back()->with($notification);
       
    }
    

   }//end Method

   public function update_Property_Facility(Request $request){

    $id = $request->id;
    if ($request->facility_name == Null) {

        $notification = array(
            "message"=>"Must Add Facility",
            "alert-type"=> "warning"
        );
        return redirect()->back()->with($notification);
        
    } else {

    Facility::where("property_id",$id)->delete();
    $facilities = Count($request->facility_name);
    if($facilities !== Null){
        for ($i=0; $i <$facilities ; $i++) { 
            Facility::insert([
                "property_id"=>$id,
                "facility_name"=> $request->facility_name[$i],
                "distance"=>$request->distance[$i],
            ]);
        }//End For

    }//End If
     
       
    }
    $notification = array(
        "message" => 'Property Facility Updated Successfully',
        "alert-type" => "warning"
       );

       return redirect()->back()->with($notification);
    
    

   }//End Method

  

    public function Delete_property($id) {

       $property = Property::find($id);
       unlink($property->property_thambnail);
        Property::find($id)->delete();

       $images = MultiImage::where("property_id",$id)->get();
       foreach($images as $img){
        unlink($img->photo_name);
        MultiImage::where("property_id",$id)->delete();

       }


        $facilities = Facility::where("property_id",$id)->get();

        foreach($facilities as $facility) {
         $facility->facility_name;
         Facility::where("property_id",$id)->delete();
        }
        $notification = array(
            "message" => 'Property Deleted Successufully',
            "alert-type" => "warning"
        );

        return redirect()->back()->with($notification);

    }//end Method

    public function details_Property($id) {
        $facilities = Facility::where("property_id",$id)->get();

        $property = Property::find($id);
 
        $type = $property->amenities_id;
        $property_ameni = explode(",",$type);
        $PropertType = PropertType::latest()->get();
        $multi_image = MultiImage::where("property_id",$id)->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where("role","agent")->where("status","active")->latest()->get();
            
 
        return view("backend.property.details_property",compact("property","facilities","PropertType","amenities","activeAgent","property_ameni","multi_image"));
         
        


    }//End Method


    public function inactive_Property(Request $request){

        $pro_id = $request->id;

        Property::findOrFail($pro_id)->update([
       "status" => 0,
       "updated_at" => Carbon::now()
        ]);
        $notification = array(
            "message" => 'Property  Inactived successfully',
            "alert-type" => "success"
        );

        return redirect()->route("all.Properties")->with($notification);

      }//End Method
      public function active_Property(Request $request){

        $pro_id = $request->id;

        Property::findOrFail($pro_id)->update([
       "status" => 1,
       "updated_at" => Carbon::now()
        ]);
        $notification = array(
            "message" => 'Property  Actived successfully',
            "alert-type" => "success"
        );

        return redirect()->route("all.Properties")->with($notification);

      }//End Method


      public function AdminPackageHistory() {
   
        $packageHistory = PackagePlan::get();

    return view("admin.package.package_history",compact('packageHistory'));


      }//End Method

      public function adminPackageInvoice($id) {

        
        $packagehistory = PackagePlan::where("id",$id)->first();
        $username = $packagehistory->user->name;
        
    
        $pdf = Pdf::loadView('agent.package.packageHistory', compact('packagehistory'))
        ->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' =>public_path()
        ]);
        return $pdf->download($username."_".'invoice.pdf');
    
     }//End Method

}
