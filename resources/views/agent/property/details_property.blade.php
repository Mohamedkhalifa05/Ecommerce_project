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

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    <h6 class="card-title">Property Details</h6>
                    <p class="text-muted mb-3"></p>
                    <div class="table-responsive">
                            <table class="table table-striped ">
                                
                                <tbody>
                                    <tr>
                                        <td>Property Name</td>
                                        <td><code>{{$property->property_name}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Property status</td>
                                        <td><code>{{$property->property_status}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Lowest Price</td>
                                        <td><code>{{$property->lowest_price}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Max Price</td>
                                        <td><code>{{$property->max_price}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>BedRooms</td>
                                        <td><code>{{$property->bedrooms}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Bathrooms</td>
                                        <td><code>{{$property->bathrooms}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Garage</td>
                                        <td><code>{{$property->garage}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Garage Size</td>
                                        <td><code>{{$property->garage_size}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><code>{{$property->address}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><code>{{$property->city}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><code>{{$property->pstate->state_name}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Postal Code</td>
                                        <td><code>{{$property->postal_code}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Main Image</td>
                                        <td>
                                        <img src="{{asset($property->property_thambnail)}}" style="width: 100px;height:70px" alt="Main Image">    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if($property->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                                  @else
                                           <span class="badge rounded-pill bg-danger">Inactive</span>
                                                  @endif
                                        </td>
                                    </tr>
                               
                                  
                                   
                                   
                                   
                                </tbody>
                            </table>
                    </div>
  </div>
</div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    {{-- <h6 class="card-title">Hoverable Table</h6> --}}
                    {{-- <p class="text-muted mb-3">Add class <code>.table-hover</code></p> --}}
                    <div class="table-responsive">
                            <table class="table table-striped">
                               
                                <tbody>
                                    <tr>
                                        <td>Property code</td>
                                        <td><code>{{$property->property_code}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Property Video</td>
                                        <td><code>{{$property->property_video}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Neighborhood</td>
                                        <td><code>{{$property->neighborhood}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Latitude</td>
                                        <td><code>{{$property->latitude}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Longitude</td>
                                        <td><code>{{$property->longitude}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Property Type</td>
                                        <td><code>{{$property['type']['type_name']}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Property Amenities</td>
                                       
                                       <td>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">

                                            @foreach($amenities as $ameni)
                                           {{-- <option style="background-color: #6571FF" value="{{ $ameni->id }}" {{(in_array($ameni->id,$property_ameni)) ? "selected" : "" }}>{{ $ameni->amenitie_name }}</option> --}}
                                           <option style="background-color: #6571FF" value="{{ $ameni->amenitie_name}}" {{(in_array($ameni->amenitie_name,$property_ameni)) ? "selected" : "" }}>{{ $ameni->amenitie_name }}</option>

                                          @endforeach
                           
                                       </select>
                                       </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Agent</td>
                                        @if ($property->agent_id == Null)
                                        <td><code>Admin</code></td>
                                        @else
                                        <td><code>{{$property["user"]['name']}}</code></td>
                                            
                                        @endif
                                        
                                    </tr>
                                    <tr>
                                        <td>Short Description</td>
                                        <td><code>{{$property->short_descp}}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Long Description</td>
                                        <td><code>{!!$property->long_descp!!}</code></td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Property size</td>
                                        <td><code>{!!$property->property_size!!}</code></td>
                                    </tr> --}}
                                    
                                </tbody>
                            </table>

                            <br><br>
                            @if ($property->status == 1)
                            <form method="post" action="{{route('agent.inactive.property')}}" >
                                @csrf
                            <input type="hidden" name="id" value="{{$property->id}}">
                           <input type="submit" class="btn btn-primary" value="Inactive">
   
                            </form> 
                            @else
                            <form method="post" action="{{route('agent.active.property')}}" >
                                @csrf
                            <input type="hidden" name="id" value="{{$property->id}}">

                          <input type="submit" value="Active" class="btn btn-primary">

                            </form> 
                            @endif
                    </div>
  </div>
</div>
        </div>
    </div>
        
</div>
    
@endsection