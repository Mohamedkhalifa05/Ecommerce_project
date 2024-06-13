<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function All_BlogCategory(){
      $categories = BlogCategory::latest()->paginate(3);
      return view("backend.blog.all_blog_category",compact("categories"));
    }//End Method 


    public function BlogCategory_Store(Request $request){
      $category_name = $request->category_name;
      $category_slug = strtolower(str_replace(" ","-",$category_name));

      $blogCategory = new BlogCategory();
      $blogCategory->category_name = $category_name;
      $blogCategory->category_slug = $category_slug;
      $blogCategory->created_at = Carbon::now();

      $blogCategory->save();

      $notification = array(
        "message" => " New BlogCategory Added Successfully",
        "alert-type" => "success"
    ) ;


    return redirect()->route("all.blog.category")->with($notification);

    }//End Method 


    public function EditBlogCategory($id){
      $categories = BlogCategory::findOrFail($id);
      return response()->json($categories);
    }//End Method 

    //BlogCategory Update
    public function UpdateBlogCategory(Request $request){ 

      $cat_id = $request->cat_id;
  
          BlogCategory::findOrFail($cat_id)->update([ 
  
              'category_name' => $request->category_name,
              'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),  
          ]);
  
            $notification = array(
              'message' => 'BlogCategory Updated Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('all.blog.category')->with($notification);
  
  
      }// End Method 
      public function Delete_BlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        
        $notification = array(
          'message' => 'BlogCategory Deleted Successfully',
          'alert-type' => 'success'
      );

      return redirect()->route('all.blog.category')->with($notification);

      }//End Method 

      
    

  

}
