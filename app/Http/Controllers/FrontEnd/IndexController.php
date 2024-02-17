<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use Illuminate\Http\Request;

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
       dd($related_properties);
        return view('frontend.property.property_details',compact('property','multiImage','property_amen','facility','related_properties'));

    }//End Method
}
