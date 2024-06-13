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
       {{-- <a href="{{route('add.testimonals')}}"
       class="btn btn-inverse-info">
         Add Blog Category </a> --}}
         <!-- Button trigger modal -->
<button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Category
</button>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Blog Category</h6>
    {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Blog Category Name</th>
            <th>Blog Category Slug</th>
            
            <th>Action</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key=>$category)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->category_slug}}</td>

            {{-- <td> <img  style="width:70px;height:40px"
              src="{{asset($test->image)}}" ></td>--}}
            <td> 
              <button type="button" 
              class="btn btn-inverse-warning"
               data-bs-toggle="modal" 
               data-bs-target="#catedit" id="{{ $category->id }}" onclick="categoryEdit(this.id)" > 
                Edit
               </button>
               <a href="{{route('delete.blog.category',$category->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
                {{-- <a href="{{route('edit.testimonial',$test->id)}}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{route('delete.testimonial',$test->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a> --}}
            </td>
           
          </tr>
          @endforeach
        </tbody>
        
      </table>
     
      <div>
        <ul class="pagination clearfix">
        {{$categories ->links("vendor.pagination.custom")}} 
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" method="POST" action="{{ route('store.blog.category') }}" class="forms-sample">
  
          

           @csrf
             
              <div class=" form-group mb-3">
                  <label for="exampleInputPassword1" class="form-label">Blog Category Name</label>
                  <input type="text" name="category_name" class="form-control" >
                  {{-- <input type="text" name="amenitie_name" class="form-control 
                  @error('amenitie_name') isinvalid  @enderror"  
                  id="amenitie_name" autocomplete="off" placeholder="Amenitie Name">
                  @error('amenitie_name')
                      <span class="text-danger">{{$message}}</span>
                  @enderror --}}
                  

              </div>
             
           
            
              
              
             {{-- <button type="submit" class="btn btn-primary me-3">Add Amenitie</button> --}}
         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

    </form>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="catedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{ route('update.blog.category') }}" class="forms-sample">
        @csrf
 
    <input type="hidden" name="cat_id" id="cat_id">

        <div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">Blog Category Name </label>
  <input type="text" name="category_name" class="form-control" id="cat" >
           
        </div> 
     

      </div> 
      <div class="modal-footer">
        
    <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
   </form>

    </div>
  </div>
</div>

{{-- <script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
            category_name: {
                  required : true,
              },
              
          },
          messages :{
              category_name: {
                  required : 'Please Enter Category Name',
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
  
</script> --}}

<script type="text/javascript">
  function categoryEdit(id){
    $.ajax({
      type: 'GET',
      url: '/blog/category/'+id,
      dataType: 'json',
      success:function(data){
        // console.log(data)
        $('#cat').val(data.category_name);
        $('#cat_id').val(data.id);
      } 
    })
  }
</script>

{{-- <script type="text/javascript">
public function CategoryEdit(id) {
  $.ajax({
    type:"GET",
    url:"blog/category"+id,
    datatype:"json",
    success:function(data){
      console.log(data);
    }
  })
}

</script> --}}
    
@endsection

