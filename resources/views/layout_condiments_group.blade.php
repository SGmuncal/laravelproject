@extends('layouts.adminnavbar')

@section('admin_content')


<div class="container">
	<div class="jumbotron" style="background-image: url('./Images/condiments.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">
		<div class="col-md-9">
			<h2>Condiments Group</h2>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-primary form-control" data-toggle="modal" data-target="#condimentModal">Create Condiment Group <i class="far fa-edit"></i></a>
		</div>
	</div>
	<br>
  	<div class="jumbotron">
  		<div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" id="tables" style="overflow-x: scroll;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Condiment Section</th>
              <th>Condiment Name</th>
              <th>Condiment Screen Name</th>
              <th>Condiment Price</th>
              <th>Condiment Image</th>
              <th>Action</th>
            </tr>
          </thead>
          	<tbody>
	         	@foreach($condiments_table as $condiments_data) 

	         		<tr>
	         			<td>{{$condiments_data->cat_condi_id}}</td>
	         			<td>{{$condiments_data->condiment_section_name}}</td>
	         			<td>{{$condiments_data->cat_condi_name}}</td>
	         			<td>{{$condiments_data->cat_condi_screen_name}}</td>
	         			<td>{{$condiments_data->cat_condi_price}}</td>
	         			
	         			@if($condiments_data->cat_condi_image == '')
	         				<td>No Image Uploaded</td>
	         			@else
	         				<td><img src="{{url('/storage/'.$condiments_data->cat_condi_image.'')}}" style="height:130px; width:250px;" class="img-fluid"></td>
	         			@endif
	         			<td>
                           <button class="btn btn-primary" id="condiment_editBtn" value="{{$condiments_data->cat_condi_id}}">Edit <i class="far fa-edit"></i></button>
                            <br>
                         	<br>
      
                            <button  class="btn btn-danger" id="condiment_deleteBtn" value="{{$condiments_data->cat_condi_id}}">Delete <i class="far fa-trash-alt"></i></button>
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


<div class="modal fade" id="condimentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Condiment</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						
						<div class="row">
							<div class="col-md-6">
								<label>Condiment Section</label>
								<select class="form-control" id="select_condiments_value">
									<option selected="" disabled="" >Select Condiments Section</option>
									@foreach($condiment_section_table as $condiment_section)
		         						
											<option value="{{$condiment_section->condiments_section_id}}">{{$condiment_section->condiment_section_name}}</option>
										
		         					@endforeach
	         					</select>		
							</div>
						</div>
						<br>
						<div class="row">

							<div class="col-md-6">
								<label>Condiment Name</label>
								<input placeholder="" name="condiment_name" class="form-control" id="condiment_name" type="text" class="validate">
							</div>

							<div class="col-md-6">
								<label>Condiment Screen Name</label>
								<input type="text"  id="condiment_screen" class="form-control"/>
							</div>

						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
								<label>Condiment Price</label>
								<input type="number" name="condiment_price" id="condiment_price" class="currency form-control"  min="0.00" step="0.00" max="2500" value="0.00" />
							</div>
							<div class="col-md-6">
							  <label>Condiment Image</label>
						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="condiment_image">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
						</div>

					</div>
				</form>
		    	
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="btn_condiment_insert">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>




<div class="modal fade" id="edit_condimentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Condiment</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						
						<input type="hidden" id="append_cat_condi_id" value="" name="">
						
						<div class="row">

							<div class="col-md-6">
								<label>Condiment Name</label>
								<input placeholder="" name="condiment_name" class="form-control" id="append_condiment_name" type="text" class="validate">
							</div>

							<div class="col-md-6">
								<label>Condiment Screen Name</label>
								<input type="text"  id="append_condiment_screen" class="form-control"/>
							</div>

						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
								<label>Condiment Price</label>
								<input type="number" name="condiment_price" id="append_condiment_price" class="currency form-control"  min="0.00" step="0.00" max="2500" value="0.00" />
							</div>
							<div class="col-md-6">
							  <label>Condiment Image</label>
						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="append_condiment_image">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
						</div>

					</div>
				</form>
		    	
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="update_btn_condiment">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>


<br><br><br><br>
@endsection

