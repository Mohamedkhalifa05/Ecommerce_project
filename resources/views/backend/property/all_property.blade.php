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
       <a href="{{route('add.Property')}}" class="btn btn-inverse-info"> Add Property </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All property Types</h6>
    {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>#</th>

            <th>Image</th>

            <th>Name</th>

            <th>P Type</th>


            <th>Status Type</th>

            <th>City</th>

            <th>Code</th>

            <th>Status</th>

            {{-- <th>amenitie_id</th> --}}
            

            <th>Action</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach ($properties as $key=>$property)
          <tr>
            <td>{{$key+1}}</td>
            <td><img src="{{asset($property->property_thambnail)}}"
               alt="property_img" style="height: 40px;width:70px"></td>
               <td>{{ $property->property_name }}</td> 
               <td>{{ $property["type"]["type_name"] }}</td> 
               <td>{{ $property->property_status }}</td> 
               <td>{{ $property->city }}</td> 
               <td>{{ $property->property_code }}</td> 
               <td>
                      @if($property->status == 1)
                <span class="badge rounded-pill bg-success">Active</span>
                      @else
               <span class="badge rounded-pill bg-danger">InActive</span>
                      @endif

               </td> 
            <td>
              <a href="{{route('details.property',$property->id)}}" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a>

                <a href="{{route('edit.property',$property->id)}}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                <a href="{{route('delete.property',$property->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
            </td>
           
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
        </div>
    </div>

</div>
    
@endsection

