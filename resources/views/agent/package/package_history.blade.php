@extends("agent.agent_dashboard")
@php
$id = Auth::id();
$userData = App\Models\User::findOrFail($id);
@endphp
@section('title')
{{$userData->name}}
@endsection


@section('agent')
<div class="page-content">
  

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
       <a href="{{route('agent.add.property')}}" class="btn btn-inverse-info"> Add Property </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Package History</h6>
    {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>#</th>

            <th>Image</th>

            <th>Package</th>

            <th>Credit</th>


            <th>Amount</th>

            <th>Invoice</th>

             <th>Date</th>

            <th>Action</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach ($packageHistory as $key=>$package)
          <tr>
            <td>{{$key+1}}</td>
            <td><img src="{{(!empty($package->user->photo)) ? asset($package->user->photo) : url('upload/no_image.jpg')}}"
               alt="agent_img" style="height: 40px;width:70px"></td>
               <td>{{ $package->Package_name }}</td> 
               <td>{{ $package->package_credit }}</td> 
               <td>{{ $package->package_amount }} $</td> 
               <td>{{ $package->invoice}}</td> 
               {{-- <td>{{ $package->created_at->diffForHumans()}}</td>--}}
               <td>{{ $package->created_at->format('l d M Y')}}</td> 
                 
             
            <td>
                <a href="{{route('agent.package.invoice',$package->id)}}" class="btn btn-inverse-warning" title="Download"><i data-feather="download"></i></a>
                
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

