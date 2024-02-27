<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class WishlistController extends Controller
{
    //


     public function AddWishlist(Request $request,$property_id) {
        if (Auth::check()) {
            $exists = Wishlist::where("user_id",Auth::id())
            ->where("property_id",$property_id)->first();
            if (!$exists) {
                Wishlist::insert([
                    "user_id"=>Auth::id(),
                    "property_id" => $property_id,
                    "created_at" => Carbon::now()
                ]);

           

            

                return response()->json([
                    'success'=> 'successfully added to on your Wishlist'
                ]);
            }else {
                return response()->json([
                    'error'=> 'This Property is Already in your Wishlist'
                ]);

            }

        }else {
            return response()->json([
                'error'=> 'At First Login Your Account'
            ]);
        }

     }//end Method

     public function UserWishlist() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        

        return view('frontend.dashboard.wishlist',compact('userData'));

     }//End Method

     public function GetWishlistProperty() {
        
        $wishlist = Wishlist::with('property')->where('user_id',Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);

     }//End Method 

     public function wishlistRemove($id) {

        Wishlist::where('user_id',Auth::id())->where("id",$id)->delete();
        return response()->json(['success' => "Successfully Property Remove"]);

     }//End Method

}
