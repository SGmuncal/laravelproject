@extends('layouts.adminnavbar')

@section('admin_content')



	<div class="jumbotron" style="background-image: url('./Images/sub_group-ConvertImage.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">
		<div class="col-md-9">
			<h2>Sub Menu Group</h2>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-primary form-control" id="hoverButton" data-toggle="modal" data-target="#createsubmenugroupModal">Create Sub Group Menu <i class="far fa-edit"></i></a>
		</div>
	</div>
	<br>
  	<div class="jumbotron" style="background-color:white; font-size: 14px;">
  		<div class="row">
	    <div class="col-md-12">
	      <div class="table-responsive">
	        <table class="table" id="tables" style="overflow-x: scroll;">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Section Menu</th>
	              <th>Sub Menu Name</th>
	              <th>Sub Menu Description</th>
	              <th>Sub Menu Images</th>
	              <th>Action</th>
	            </tr>
	          </thead>
	          	<tbody>
		         	@foreach($sub_menu_section as $sub_section_data)
		         		<tr>
		         			<td>{{$sub_section_data->menu_id}}</td>
		         			<td>{{$sub_section_data->menu_sec_name}}</td>
		         			<td>{{$sub_section_data->menu_name}}</td>
		         			<td>{{$sub_section_data->menu_desc}}</td>
		         			
		         			@if($sub_section_data->menu_main_image == '')
		         				<td>No Image Uploaded</td>
		         			@else
								<td><img src="{{url('/storage/'.$sub_section_data->menu_main_image.'')}}" style="height:180px; width:250px;" class="img-fluid"></td>
		         			@endif
		         			<td>
	                           <button class="btn btn-primary" id="sub_menu_group_editBtn" value="{{$sub_section_data->menu_id}}">Edit <i class="far fa-edit"></i></button>
	                            <br>
	                         	<br>
	      
	                            <button  class="btn btn-danger" id="sub_menu_group_deleteBtn" value="{{$sub_section_data->menu_id}}">Delete<i class="far fa-trash-alt"></i></button>
	                        </td>
		         		</tr>
		         	@endforeach   
	            </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
  	</div>



<div class="modal fade" id="createsubmenugroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Sub Menu Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						
						<div class="row">
							<div class="col-md-6">
								<label>Choose your menu section</label>
								<select name="content_page"  class="form-control" id="menu_section_choices">
									<option disabled="" selected="true" value="">Menu Section</option>
							     	@foreach($menu_section_id as $choices)
								      	<option value="{{$choices->menu_sec_id}}">{{$choices->menu_sec_name}}</option>
								    @endforeach
							    </select>
							</div>

							<div class="col-md-6">
								<label>Menu Name</label>
								<input placeholder="" name="menu_name" class="form-control" id="menu_name" type="text" class="validate">
							</div>
						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
							  <label>Menu Image</label>
						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="menu_image_file">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
						</div>

						<br><br>

						
						<div class="row">
							<div class="col-md-12">
							<label>Menu Description</label>
								<textarea name="content_article" id="menu_description" class="form-control"></textarea>
								<script>
									CKEDITOR.replace( 'content_article' );
								</script>
							</div>
						</div>

					</div>
				</form>
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="btn_menu_insert">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>


<div class="modal fade" id="editSubmenugroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Sub Menu Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						<input type="hidden" name="" id="hidden_sub_menu_sec_id" value="">
						<div class="row">
							
							<div class="col-md-6">
								<label>Sub Menu Name</label>
								<input placeholder="" name="menu_name" class="form-control" id="sub_menu_name" type="text" class="validate">
							</div>
						


					
							<div class="col-md-6">
							  <label>Sub Menu Image</label>

						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="sub_menu_image_file">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
					

						</div>

						<br><br>

						
						<div class="row">
							<div class="col-md-12">
							<label>Sub Menu Description</label>
								<textarea name="content_article" id="sub_menu_description" value="" class="form-control"></textarea>
								<script>
									CKEDITOR.replace( 'content_article' );
								</script>
							</div>
						</div>

					</div>
				</form>
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="update_btn_sub_menu_insert">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>







<br><br><br><br>
@endsection

