@extends('layouts.adminnavbar')

@section('admin_content')


<div class="container">
	<div class="jumbotron" style="background-image: url('./Images/group-ConvertImage.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">
		<div class="col-md-9">
			<h2>Menu Section</h2>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-primary form-control" data-toggle="modal" data-target="#exampleModalCenter">Create Group Menu <i class="far fa-edit"></i></a>
		</div>
	</div>
	<br>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" id="tables" style="overflow-x: scroll;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Menu Name</th>
              <th>Menu Description</th>
              <th>Action</th>
            </tr>
          </thead>
          	<tbody>
	         	@foreach($menu_section as $section_data)
	         		<tr>
	         			<td>{{$section_data->menu_sec_id}}</td>
	         			<td>{{$section_data->menu_sec_name}}</td>
	         			<td>{{$section_data->menu_sec_desc}}</td>
	         			<td>
                            <button class="btn btn-primary" id="menu_group_editBtn" value="{{$section_data->menu_sec_id}}">Edit <i class="far fa-edit"></i></button>
                            <br>
                         	<br>
      
                            <button  class="btn btn-danger" id="menu_group_deleteBtn" value="{{$section_data->menu_sec_id}}">Delete<i class="far fa-trash-alt"></i></button>
                     
                        </td>
	         		</tr>
	         	@endforeach   
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Menu Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    		<div class="row">
						<div class="col-md-6">
							<label>Menu Group Name</label>
							<input placeholder="For sharing..." name="menu_name_category" value="" class="form-control" id="menu_value" type="text" class="validate">
						</div>
						<div class="col-md-6">
						  <label>Menu Group Desc</label>
					      <textarea class="form-control" name="menu_sec_desc" id="menu_sec_desc"></textarea>
					    </div>
					</div>
		    	
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="save_menu_button">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>







<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="editModalmenugroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Menu Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    		<input type="hidden" id="hidden_menu_sec_id" value="" name="">
		    		<div class="row">
						<div class="col-md-6">
							<label>Menu Group Name</label>
							<input placeholder="For sharing..." name="menu_name_category" value="" class="form-control" id="edit_menu_value" type="text" class="validate">
						</div>
						<div class="col-md-6">
						  <label>Menu Group Desc</label>
					      <textarea class="form-control" name="menu_sec_desc" value="" id="edit_menu_sec_desc"></textarea>
					    </div>
					</div>
		    	
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="update_menu_group_button">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>





<br><br><br><br>
@endsection

