<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

     public function All_Posts() {

    $posts = BlogPost::latest()->paginate(3);

    return view("backend.post.all_post",compact("posts"));

     }//End Method 
     

     public function add_Post(){
      $CatBlog = BlogCategory::latest()->get();
     return view("backend.post.add_post",compact('CatBlog'));
     }//End Method

     public function Post_Store(Request $request) {


      //validation

      $request->validate([
          "post_title" => "required|unique:blog_posts,post_title|max:200",
          "blog_cat_id" => "required",
          "short_desc" => "required|min:10",
          "long_desc" => "required|max:200",
          "post_image" => "required|image|mimes:jpeg,png,jpg"
      ],[
         "post_title.required" => "You must add Post Title" ,
         "post_title.unique" => "This  Post Title Is Already Exist !!",
         "post_title.max" => "The Post Title must less than 200 Character" ,
         "blog_cat_id.required" => "You must add Blog Category" ,
         "short_desc.min" => "Short Description  must more than 10 Character" ,
         "short_desc.required" => "You must add short Description" ,
         "long_desc.required" => "You must add Long Description" ,
         "long_desc.max" => "Long Description  must less than 200 Character" ,

         "post_image.required" =>"You must add The Post Image",
         "post_image.image" =>"You must add  Image",
         "post_image.mimes" =>"Image must be jpeg Or png Or jpg Extensions ", 
          
      ]);

      // Add State
      
      $image = $request->file('post_image');
      $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
      Image::make($image)->resize(370,250)->save("upload/post/".$name_gen);
      $save_url = "upload/post/".$name_gen;

      $blog_post = new BlogPost() ;

      $blog_post->post_title = $request->post_title;
      $blog_post->blog_cat_id= $request->blog_cat_id;
      $blog_post->user_id= Auth::user()->id;
      $blog_post->post_slug= strtolower(str_replace(' ','-',$request->post_title));
      $blog_post->created_at = Carbon::now();
      $blog_post->post_tags = $request->post_tags;
      $blog_post->long_desc = $request->long_desc;
      $blog_post->short_desc = $request->short_desc;
      $blog_post->post_image = $save_url;

      $blog_post->save();

      $notification = array(
          "message" => "Add New Blog Post Successfully",
          "alert-type" => "success"
      ) ;


      return redirect()->route("all.posts")->with($notification);



  }//End Method

  public function Edit_Post($id) {

    $post = BlogPost::findOrFail($id);
    $Catblog = BlogCategory::latest()->get();
    return  view("backend.post.edit_post",compact("post","Catblog"));

}//End Method



public function UpdatePost(Request $request){

  $post_id = $request->post_id;
 $post = BlogPost::findOrFail($post_id);
  if ($request->file('post_image')) {

$image = $request->file('post_image');
$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
Image::make($image)->resize(370,250)->save('upload/post/'.$name_gen);
$save_url = 'upload/post/'.$name_gen;
//delete post image
unlink(public_path($post->post_image));
BlogPost::findOrFail($post_id)->update([
  "post_title" => $request->post_title,
    "blog_cat_id"=> $request->blog_cat_id,
    "user_id"=> Auth::user()->id,
     "post_slug"=> strtolower(str_replace(' ','-',$request->post_title)),
     "post_tags" => $request->post_tags,
    "long_desc" => $request->long_desc,
    "short_desc" => $request->short_desc,
    "post_image" => $save_url,
    'updated_at' => Carbon::now()

]);

$notification = array(
      'message' => 'Blog Post Updated Successfully',
      'alert-type' => 'success'
  );

  return redirect()->route('all.posts')->with($notification);

  }else{

BlogPost::findOrFail($post_id)->update([
 "post_title" => $request->post_title,
    "blog_cat_id"=> $request->blog_cat_id,
    "user_id"=> Auth::user()->id,
     "post_slug"=> strtolower(str_replace(' ','-',$request->post_title)),
     "post_tags" => $request->post_tags,
    "long_desc" => $request->long_desc,
    "short_desc" => $request->short_desc,
    
    'updated_at' => Carbon::now()
]);

$notification = array(
      'message' => 'Blog Post Updated Successfully',
      'alert-type' => 'success'
  );

  return redirect()->route('all.posts')->with($notification);

  } // end else 

}// End Method 


public function Delete_Post($id) {

  $post = BlogPost::findOrFail($id);
  $img = $post->post_image;
  unlink($img);

  $post->delete();
  
  $notification = array(
      "message" => "this Post  deleted Successfully",
      "alert-type" => "success"
  ) ;


  return redirect()->back()->with($notification);
 



}//end Method

public function Blog_Details($slug){
  $blog = BlogPost::where("post_slug",$slug)->first();
  $tags = $blog->post_tags;
  $all_tags = explode(",",$tags);
  $bcat =  BlogCategory::latest()->get();
  $dpost = BlogPost::latest()->limit(3)->get();
  return view("frontend.blog.blog_details",compact('blog','all_tags',"dpost","bcat"));
  }//End Method
  public function Blog_Details_side($id){
    $blog = BlogPost::where("id",$id)->first();
    $tags = $blog->post_tags;
    $all_tags = explode(",",$tags);
    $bcat =  BlogCategory::latest()->get();
    $dpost = BlogPost::latest()->limit(3)->get();
    return view("frontend.blog.blog_details",compact('blog','all_tags',"dpost","bcat"));
    }//End Method

  public function Blog_CatList($id){
  $blog = BlogPost::where("blog_cat_id",$id)->get();
  $breadcat = BlogCategory::where('id',$id)->first();
  $bcategory = BlogCategory::latest()->get();
  $dpost = BlogPost::latest()->limit(3)->get();
  return view("frontend.blog.blog_cat_list",compact("blog",'breadcat','bcategory','dpost'));
  }//End Method
  

}
