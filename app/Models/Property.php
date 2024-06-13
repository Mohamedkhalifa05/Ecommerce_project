<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

     public function type() {

        return $this->belongsTo(PropertType::class,"ptype_id","id");

     }//End Method
     
     public function pstate() {

      return $this->belongsTo(State::class,"state","id");

     }//end method


     public function Amenitie() {

      return $this->belongsTo(Amenities::class,"amenities_id","id");

     }//End Method
     public function user() {

      return $this->belongsTo(User::class,"agent_id","id");

     }//end method
}
