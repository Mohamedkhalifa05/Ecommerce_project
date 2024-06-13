@extends("admin.admin_dashboard")
@php
$id = Auth::id();
$userData = App\Models\User::findOrFail($id);
@endphp
@section('title')
{{$userData->name}}
@endsection


@section('admin')
<div class="page-content">
  

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
       <a href="{{route('add.state')}}"class="btn btn-inverse-info">
         Add State </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All states</h6>
    {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>State Name</th>
            <th>State Image</th>
            <th>Action</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach ($states as $key=>$state)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$state->state_name}}</td>
            <td> <img  style="width:70px;height:40px"
              src="{{asset($state->state_image)}}" ></td>
            <td>
                <a href="{{route('edit.state',$state->id)}}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{route('delete.state',$state->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
            </td>
           
          </tr>
          @endforeach
        </tbody>
        
      </table>
     
      <div>
        <ul class="pagination clearfix">
        {{$states ->links("vendor.pagination.custom")}} 
      </ul> 
    </div>
  </div>
</div>
        </div>
    </div>

</div>
{{-- <ul class="pagination clearfix">
  <li><a href="property-list.html" class="current">1</a></li>
</ul>
<div> --}}
  {{-- <ul class="pagination clearfix">
  {{$states ->links("vendor.pagination.custom")}} 
</ul> --}}

  {{-- @if ($property->count() == 1)
  <ul class="pagination clearfix">
      <li><a href="property-list.html" class="current">1</a></li>
  </ul>
  @else --}} 
  {{-- {{$property ->links("vendor.pagination.custom")}} --}}
  {{-- {{-- @endif --}}
</div>
    
@endsection

