<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    //
   

    public function AddCompare(Request $request,$property_id) {
        if (Auth::check()) {
            $exists = Compare::where("user_id",Auth::id())
            ->where("property_id",$property_id)->first();
            if (!$exists) {
                Compare::insert([
                    "user_id"=>Auth::id(),
                    "property_id" => $property_id,
                    "created_at" => Carbon::now()
                ]);

           

            

                return response()->json([
                    'success'=> 'successfully added to on your CompareList'
                ]);
            }else {
                return response()->json([
                    'error'=> 'This Property is Already in your CompareList'
                ]);

            }

        }else {
            return response()->json([
                'error'=> 'At First Login Your Account'
            ]);
        }

     }//end Method

     

     public function UserComparelist() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        

        return view("frontend.dashboard.compare",compact('userData'));

     }//End Method


     public function GetComparelistProperty() {
        
        $compare = Compare::with('property')->where('user_id',Auth::id())->latest()->get();

    
        return response()->json($compare);

     }//End Method 
     public function ComparelistRemove($id) {

        Compare::where('user_id',Auth::id())->where("id",$id)->delete();
        return response()->json(['success' => "Successfully Property Remove"]);

     }//End Method
}
