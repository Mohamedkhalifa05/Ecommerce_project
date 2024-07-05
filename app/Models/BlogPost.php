<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Cat() {

        return $this->belongsTo(BlogCategory::class,"blog_cat_id","id");

     }//End Method
     public function user() {

        return $this->belongsTo(User::class,"user_id","id");

     }//End Method

}
