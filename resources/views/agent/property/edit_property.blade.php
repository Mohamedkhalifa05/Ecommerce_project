@extends("agent.agent_dashboard")

@php
$id = Auth::id();
$userData = App\Models\User::findOrFail($id);
@endphp
@section('title')
{{$userData->name}}
@endsection

@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

       
        <div class="row profile-body">
          <!-- left wrapper start -->
          
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
       
       <div class="card">
    <div class="card-body">
        <h6 class="card-title">Edit Property </h6>
            {{-- <form> --}}

                <form method="post" action="{{route('agent.update.Property')}}" id="myForm" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" name="id" value="{{$property->id}}">

    <div class="row">
        <div class="col-sm-6 form-group">
            <div class="mb-3">
                <label class="form-label">Property Name </label>
                <input type="text" value="{{$property->property_name}}" name="property_name" class="form-control"  >
            </div>
        </div><!-- Col -->
        <div class="col-sm-6">
            <div class="mb-3 form-group">
                <label class="form-label">Property Status</label>
               <select name="property_status" class="form-select" id="exampleFormControlSelect1">
                <option selected="" disabled="">Select Status</option>
                <option value="rent" {{$property->property_status == "rent"
                ? "selected" : ""}}>For Rent</option>
                <option value="buy" {{$property->property_status == "buy"
                    ? "selected" : ""}}>For Buy</option> 
            </select>
            </div>
        </div><!-- Col -->


    <div class="col-sm-6">
            <div class="mb-3 form-group">
                <label class="form-label">Lowest Price </label>
                <input type="text" value="{{$property->lowest_price}}" name="lowest_price" class="form-control"  >
            </div>
        </div><!-- Col -->


            <div class="col-sm-6">
            <div class="mb-3 form-group">
                <label class="form-label">Max Price </label>
                <input type="text" value="{{$property->max_price}}" name="max_price" class="form-control"  >
            </div>
        </div><!-- Col -->


         {{-- <div class="col-sm-6">
            <div class="mb-3 form-group">
                <label class="form-label">Main Thambnail </label>
                <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)"  >

                <img src="" id="mainThmb">

            </div>
        </div><!-- Col --> --}}



         <div class="col-sm-12">
            <div class="mb-3 form-group">
                <label class="form-label">Multiple Image </label>
                <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="" >
 
         <div class="row" id="preview_img"> </div>

            </div>
        </div><!-- Col -->





    </div><!-- Row -->



    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">BedRooms</label>
                <input type="text" value="{{$property->bedrooms}}" name="bedrooms"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Bathrooms</label>
                <input type="text" value="{{$property->bathrooms}}" name="bathrooms"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Garage</label>
                 <input type="text" value="{{$property->garage}}" name="garage"  class="form-control" >
            </div>
        </div><!-- Col -->

          <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Garage Size</label>
                 <input type="text" value="{{$property->garage_size}}" name="garage_size"  class="form-control" >
            </div>
        </div><!-- Col --> 

    </div><!-- Row -->


    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" value="{{$property->address}}" name="address"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" value="{{$property->city}}" name="city"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">State</label>
                 {{-- <input type="text" value="{{$property->state}}" name="state"  class="form-control" > --}}
                 <select name="state" class="form-select" id="exampleFormControlSelect1">
                    <option selected="" disabled="">Select Type</option>
                   @foreach($pstate as $state)
                    <option value="{{ $state->id }}"
                        {{$state->id  == $property->state ? "selected" : ""}}
                        >{{ $state->state_name }}</option>
                   @endforeach
                </select>
            </div>
        </div><!-- Col -->

          <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Postal Code </label>
                 <input type="text" value="{{$property->postal_code}}" name="postal_code"  class="form-control" >
            </div>
        </div><!-- Col --> 

    </div><!-- Row -->


    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <label class="form-label">Property size</label>
                <input type="text" value="{{$property->property_size}}" name="property_size"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-4">
            <div class="mb-3">
                <label class="form-label">Property Video</label>
                <input type="text" value="{{$property->property_video}}" name="property_video"  class="form-control" >
            </div>
        </div><!-- Col -->
        <div class="col-sm-4">
            <div class="mb-3">
                <label class="form-label">Neighborhood</label>
                 <input type="text" value="{{$property->neighborhood}}" name="neighborhood"  class="form-control" >
            </div>
        </div><!-- Col -->
 

    </div><!-- Row -->




    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" value="{{$property->latitude}}" name="latitude" class="form-control" >
                <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>
            </div>
        </div><!-- Col -->
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" value="{{$property->longitude}}" name="longitude" class="form-control" >
                 <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>
            </div>
        </div><!-- Col -->
    </div><!-- Row -->



        <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Property Type </label>
                {{-- <input type="text" name="property_size"  class="form-control" > --}}
                <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                  <option selected="" disabled="">Select Type</option>
                 @foreach($PropertType as $ptype)
                  <option value="{{ $ptype->id }}"
                    {{$ptype->id  == $property->ptype_id ? "selected" : ""}}>{{ $ptype->type_name }}</option>
                 @endforeach
              </select>
            </div>
        </div><!-- Col -->
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Property Amenities </label>
                {{-- <input type="text" name="property_video"  class="form-control" > --}}
                <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">

                  @foreach($amenities as $ameni)
                 <option style="background-color: #6571FF" value="{{ $ameni->amenitie_name }}" {{(in_array($ameni->amenitie_name,$property_ameni)) ? "selected" : "" }}>{{ $ameni->amenitie_name }}</option>
                @endforeach
 
             </select>
            </div>
        </div><!-- Col -->
        {{-- <div class="col-sm-4">
            <div class="mb-3">
                <label class="form-label"> Agent </label>
                 {{-- <input type="text" name="neighborhood"  class="form-control" > 
                 <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                  <option selected="" disabled="">Select Agent</option>
                 @foreach($activeAgent as $agent)
                  <option value="{{ $agent->id }}"
                    {{$property->agent_id == $agent->id  ? "selected":""}}>{{ $agent->name }}</option>
                 @endforeach
              </select>
            </div>
        </div><!-- Col --> --}}
 

        </div><!-- Row -->


        <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="Short_des" rows="3">
                {!!$property->property_name!!}"
            </textarea>

             </div>
        </div><!-- Col -->



        <div class="col-sm-12">
           <div class="mb-3">
            <label class="form-label">Long Description</label>

            <textarea class="form-control" name="long_descp" id="tinymceExample" rows="10">
                {!!$property->property_name!!}
            </textarea>

           </div>
        </div><!-- Col -->


        <hr>

         <div class="mb-3">
        <div class="form-check form-check-inline">
            <input type="checkbox" {{$property->featured == '1' ? "checked": ""}} name="featured" value="1" class="form-check-input" id="checkInline1">
            <label class="form-check-label" for="checkInline1">
               Features Property 
            </label>
         </div>


         <div class="form-check form-check-inline">
            <input type="checkbox" name="hot" {{$property->hot == "1" ? "checked": ""}} value="1" class="form-check-input" id="checkInline">
            <label class="form-check-label" for="checkInline">
                Hot Property 
            </label>
        </div>


        </div>


        <!--   //////////// Facilities Option /////////////// -->

        <div class="row add_item">
            <div class="col-md-4">
                  <div class="mb-3">
                        <label for="facility_name" class="form-label">Facilities </label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                              <option value="">Select Facility</option>
                              <option value="Hospital">Hospital</option>
                              <option value="SuperMarket">Super Market</option>
                              <option value="School">School</option>
                              <option value="Entertainment">Entertainment</option>
                              <option value="Pharmacy">Pharmacy</option>
                              <option value="Airport">Airport</option>
                              <option value="Railways">Railways</option>
                              <option value="Bus Stop">Bus Stop</option>
                              <option value="Beach">Beach</option>
                              <option value="Mall">Mall</option>
                              <option value="Bank">Bank</option>
                        </select>
                  </div>
            </div>
            <div class="col-md-4">
                  <div class="mb-3">
                        <label for="distance" class="form-label"> Distance </label>
                        <input type="text" value="{{$property->disatance}}" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                  </div>
            </div>
            <div class="form-group col-md-4" style="padding-top: 30px;">
                  <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
            </div>
     </div> <!---end row-->

     <button type="submit" class="btn btn-primary">Save Changes </button>
            </form>
      {{-- <button type="button" class="btn btn-primary submit">Submit form</button> --}}

      {{-- <button type="button" class="btn btn-primary submit">Save Changes</button> --}}
      
    </div>
</div>



            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->
         
          <!-- right wrapper end -->
        </div>

			</div>

            {{-- ///Update Thambnail Image Update --}}

            <div class="page-content" style="margin-top: -35px">

       
                <div class="row profile-body">
                  
                  <div class="col-md-12 col-xl-12 middle-wrapper">
                    <div class="row">
               
               <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Main Thambnail Image </h6>
                    {{-- <form> --}}
        
                        <form method="post" action="{{route('agent.update.Property.thambnail')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
             <input type="hidden" name="id" value="{{$property->id}}">
             <input type="hidden" name="old_img" value="{{$property->property_thambnail}}">
                            
            <div class="row mb-3">

              <div class="form-group col-md-6">
                <label class="form-label">Main Thambnail </label>
                <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)"  >

                <img src="" id="mainThmb">

              </div>
            
              <div class="form-group col-md-6">
                <label class="form-label"></label>
                

                <img src="{{asset($property->property_thambnail)}}" style="width: 100px;height:100px" >

              </div>
            </div><!-- Col -->
           

      <button type="submit" class="btn btn-primary">Save Changes </button>

                        </form>
                    </div>
               </div>
                    </div>
                </div>
                </div>
            </div>


            {{-- ///Update Thambnail Image Update --}}


            {{-- Update Multiple Image  --}}
            <div class="page-content" style="margin-top: -35px">

       
                <div class="row profile-body">
                  
                  <div class="col-md-12 col-xl-12 middle-wrapper">
                    <div class="row">
               
               <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Main Multiple Image Image </h6>
                    {{-- <form> --}}
        
                        <form method="post" action="{{route('agent.update.Property.multi_image')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Change Image</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ( $multi_image as $key=>$image)
                                            
                                        
                                        <tr>
                                            <td >
                                               {{$key+1}}
                                            </td>
                                            <td class="py-1"><img style="width:50px;height:50px" src="{{asset($image->photo_name)}}" alt="image" ></td>
                                            
                                            <td>
                                                <input type="file" name="multi_image[{{$image->id}}]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-primary px-4" value="update Image">
                                                <a href="{{route('agent.delete.Property.multi_image',$image->id)}}" id="delete" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
            
           

           {{-- <button type="submit" class="btn btn-primary mt-3">Save Changes </button> --}}

                        </form>
                        <form method="post" action="{{route('agent.store.new.multi_image')}}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="img_id" value="{{$property->id}}">

                      <table class="table table-striped">
                        <tbody>
                           <tr>
                            <td>
                             <input type="file" name="multi_img"  class="form-control">
                                
                            </td>
                               
                                    <td>
                                        <input type="submit" class="btn btn-info px-4" style="color: white" value="Add Image">

                                    </td>
                                </tr>
                        </tbody>
                     </table>
                           

                        </form>
                    </div>
               </div>
                    </div>
                </div>
                </div>
            </div>

           {{-- ////// Update Multiple Image  --}}
           
           {{-- ///Update Property Facility  --}}

            <div class="page-content" style="margin-top: -35px">

       
                <div class="row profile-body">
                  
                  <div class="col-md-12 col-xl-12 middle-wrapper">
                    <div class="row">
               
               <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Property Facility </h6>
                    {{-- <form> --}}
        
                        <form method="post" action="{{route('agent.update.Property.facility')}}" id="myForm" enctype="multipart/form-data">
                            @csrf

                         <input type="hidden" name="id" value="{{$property->id}}">
                            @foreach ( $facilities as  $facility)
                            <div class="row add_item">

                            <div class="whole_extra_item_add" id="whole_extra_item_add">
             
                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                <div class="container mt-2">
                                   <div class="row">
                       
                                        
                                    
                                      <div class="form-group col-md-4">
                                         <label for="facility_name">Facilities</label>
                                         <select name="facility_name[]" id="facility_name" class="form-control">
                                               <option value="" >Select Facility</option>
                                               <option value="Hospital"{{ $facility->facility_name == 
                                                "Hospital" ? "selected" : ""}}>Hospital</option>
                                               <option value="SuperMarket" {{ $facility->facility_name == 
                                               'SuperMarket' ? "selected" : ""}}>Super Market</option>
                                               <option value="School" {{ $facility->facility_name == 
                                               "School" ? "selected" : ""}}>School</option>
                                               <option value="Entertainment" {{ $facility->facility_name == 
                                               "Entertainment" ? "selected" : ""}}>Entertainment</option>
                                               <option value="Pharmacy" {{ $facility->facility_name == 
                                               'Pharmacy' ? "selected" : ""}}>Pharmacy</option>
                                               <option value="Airport"{{ $facility->facility_name == 
                                              'Airport'  ? "selected" : ""}}>Airport</option>
                                               <option value="Railways" {{ $facility->facility_name == 
                                                "Railways" ? "selected" : ""}}>Railways</option>
                                               <option value="Bus Stop" {{ $facility->facility_name == 
                                               "Bus Stop"  ? "selected" : ""}}>Bus Stop</option>
                                               <option value="Beach" {{ $facility->facility_name == 
                                                "Beach" ? "selected" : ""}}>Beach</option>
                                               <option value="Mall" {{ $facility->facility_name == 
                                               "Mall" ? "selected" : ""}}>Mall</option>
                                               <option value="Bank" {{ $facility->facility_name == 
                                               "Bank" ? "selected" : ""}}>Bank</option>
                                         </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                         <label for="distance">Distance</label>
                                         <input type="text" value="{{$facility->distance}}" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                      </div>
                                      <div class="form-group col-md-4" style="padding-top: 20px">
                                         <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                         <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                            </div>
                            </div>
                             @endforeach
            <br><br>
                             <button type="submit" class="btn btn-primary">Save Changes </button>
  
               

                        </form>
                    </div>
               </div>
                    </div>
                </div>
                </div>
            </div>


            {{-- ///Update Property Facility  --}}


            


            <!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="whole_extra_item_delete" id="whole_extra_item_delete">
          <div class="container mt-2">
             <div class="row">
 
                <div class="form-group col-md-4">
                   <label for="facility_name">Facilities</label>
                   <select name="facility_name[]" id="facility_name" class="form-control">
                         <option value="">Select Facility</option>
                         <option value="Hospital">Hospital</option>
                         <option value="SuperMarket">Super Market</option>
                         <option value="School">School</option>
                         <option value="Entertainment">Entertainment</option>
                         <option value="Pharmacy">Pharmacy</option>
                         <option value="Airport">Airport</option>
                         <option value="Railways">Railways</option>
                         <option value="Bus Stop">Bus Stop</option>
                         <option value="Beach">Beach</option>
                         <option value="Mall">Mall</option>
                         <option value="Bank">Bank</option>
                   </select>
                </div>
                <div class="form-group col-md-4">
                   <label for="distance">Distance</label>
                   <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div>
                <div class="form-group col-md-4" style="padding-top: 20px">
                   <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                   <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>      
 
 
 
             <!----For Section-------->
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#whole_extra_item_delete").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of add multiple class with ajax ==============-->
 
 
 
 
 
 <script type="text/javascript">
 


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                property_name: {
                    required : true,
                },
                property_status: {
                    required : true,
                },
                 lowest_price: {
                    required : true,
                },
                 max_price: {
                    required : true,
                },
                 ptype_id: {
                    required : true,
                },

                
            },
            messages :{
                property_name: {
                    required : 'Please Enter Property Name',
                }, 
                property_status: {
                    required : 'Please Select Property Status',
                },
                lowest_price: {
                    required : 'Please Enter Lowest Price',
                },
                max_price: {
                    required : 'Please Enter Max Price',
                },
                ptype_id: {
                    required : 'Please Select Property Type',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


 <script type="text/javascript">
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
              $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    } 
 </script>


 <script> 
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>

@endsection