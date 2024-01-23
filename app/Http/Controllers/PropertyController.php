<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
