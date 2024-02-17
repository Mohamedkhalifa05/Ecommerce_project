@extends("admin.admin_dashboard")


@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<div class="page-content">
  

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
       <a href="{{route('add.agent')}}" class="btn btn-inverse-info"> Add Agent </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Agents</h6>
    <div id="status">

    {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
    <div class="table-responsive">

      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>#</th>

            <th>Image</th>
            <th>Name</th>

            <th>Role</th>

            <th>Status</th>


            <th>Change</th>

            

            <th>Action</th>

            {{-- <th>amenitie_id</th> --}}
            

          
           
          </tr>
        </thead>
        <tbody>
            @foreach ($all_agents as  $key=>$agent)
          <tr>
            <td>{{$key+1}}</td>
            <td><img src="{{(!empty($agent->photo)) ? asset($agent->photo) : url('upload/no_image.jpg')}}"
               alt="agent_img" style="height: 40px;width:70px"></td>
               <td>{{$agent->name}}</td>
               <td>{{ $agent->role }}</td> 
                <td >
                  @if($agent->status == "active")
                  <span  class="badge rounded-pill bg-success">Active</span>
                    @else
                  <span class="badge rounded-pill bg-danger">InActive</span>
                    @endif
                  </td> 
               
                

              
               
            {{-- <td>change</td> --}}
            <td>
              <input data-id="{{ $agent->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"  data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $agent->status ? 'checked' : '' }} >
            
                                </td>  
               {{-- <td>{{ $property["type"]["type_name"] }}</td> 
               <td>{{ $property->property_status }}</td> 
               <td>{{ $property->city }}</td> 
               <td>{{ $property->property_code }}</td> --}}
              
            <td>
              {{-- <a href="" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a> --}}

                <a href="{{route('agent.edit',$agent->id)}}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                <a href="{{route("agent.delete",$agent->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
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

</div>

<script type="text/javascript">
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              // console.log(data.success)
                // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }
              // End Message   
            }
        });
    })
  })
</script>
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --}}

  {{-- <script>
    setTimeout(function(){
        
   
  window. location. reload(); 
   
// To reshow on every one minute
setInterval(function() {
  window. location. reload(); 
        }, 60000);
  }, 2000);
   
  </script> --}}

 



    
@endsection


