@extends('layouts.adminnavbar')

@section('admin_content')


<div class="container">
	<div class="jumbotron" style="background-image: url('./Images/noun_bg.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">
		<div class="col-md-9">
			<h2>Noun Group</h2>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-primary form-control" data-toggle="modal" data-target="#nounModal">Create Noun Group <i class="far fa-edit"></i></a>
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
              <th>Noun Group</th>
              <th>Noun Name</th>
              <th>Noun Screen Name</th>
              <th>Noun Description</th>
              <th>Noun Price</th>
              <th>Noun Image</th>
              <th>Action</th>
            </tr>
          </thead>
          	<tbody>
	         	@foreach($noun_table as $noun_data)
	         		<tr>
	         			<td>{{$noun_data->menu_cat_id}}</td>
	         			<td>{{$noun_data->menu_name}}</td>
	         			<td>{{$noun_data->menu_cat_name}}</td>
	         			<td>{{$noun_data->menu_cat_screen_name}}</td>
	         			<td>{{$noun_data->menu_cat_desc}}</td>
	         			<td>{{$noun_data->menu_cat_price}}</td>

	         			@if($noun_data->menu_cat_image == '')
	         				<td>No Image Uploaded</td>
	         			@else
	         				<td><img src="{{url('/storage/'.$noun_data->menu_cat_image.'')}}" style="height:180px; width:250px;" class="img-fluid"></td>
	         			@endif
	         			<td>
	         				 <button class="btn btn-primary" id="noun_editBtn" value="{{$noun_data->menu_cat_id}}">Edit <i class="far fa-edit"></i></button>
                            <br>
                         	<br>
      
                            <button  class="btn btn-danger" id="noun_deleteBtn" value="{{$noun_data->menu_cat_id}}">Delete<i class="far fa-trash-alt"></i></button>
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


<div class="modal fade" id="nounModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle">Noun</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						
						
						<div class="row">
							<div class="col-md-6">
								<label>Noun Section Group</label>
								<select name="content_page"  class="form-control" id="menu_category_choices">
									<option disabled="" selected="true" value="">Menu Section</option>
							    	@foreach($menu_choices as $choices)
								      	<option value="{{$choices->menu_id}}">{{$choices->menu_name}}</option>
								      @endforeach
							    </select>
							</div>

							<div class="col-md-6">
								<label>Noun Name</label>
								<input placeholder="" name="menu_category_name" class="form-control" id="menu_category_name" type="text" class="validate">
							</div>

						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
								<label>Noun Price</label>
								<input type="number" name="menu_category_price" id="menu_category_price" class="currency form-control"  min="0.01" step="0.01" max="2500" value="0.00" />
							</div>
							<div class="col-md-6">
							  <label>Noun Image</label>
						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="menu_category_file">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
								<label>Noun Screen Name</label>
								<input type="text"  id="menu_noun_screen" class="form-control"/>
							</div>
							<div class="col-md-6">
							  
						    </div>
						</div>


						<br><br>

						
						<div class="row">
							<div class="col-md-12">
							<label>Menu Description</label>
								<textarea name="content_article" id="menu_category_description" class="form-control"></textarea>
								<script>
									CKEDITOR.replace( 'content_article' );
								</script>
							</div>
						</div>

					</div>
				</form>
		    	
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="btn_menu_category_insert">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>


<div class="modal fade" id="editnounModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Noun</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    	<form  method="post" enctype="multipart/form-data">
					<div class="container">
						
						<input type="hidden" name="" value="" id="append_hidden_noun_name">
						
						<div class="row">
						

							<div class="col-md-6">
								<label>Noun Name</label>
								<input placeholder="" name="menu_category_name" class="form-control" id="append_menu_category_name" type="text" class="validate">
							</div>

							<div class="col-md-6">
								<label>Noun Screen Name</label>
								<input type="text"  id="append_menu_noun_screen" class="form-control"/>
							</div>

						</div>

						<br><br>

						<div class="row">
							<div class="col-md-6">
								<label>Noun Price</label>
								<input type="number" name="menu_category_price" id="append_menu_category_price" class="currency form-control"  min="0.01" step="0.01" max="2500" value="0.00" />
							</div>
							<div class="col-md-6">
							  <label>Noun Image</label>
						      <div class="custom-file">	
						        <input type="file" value=""  name="file" class="custom-file-input form-control" id="append_menu_category_file">
						        <label class="custom-file-label" for="inputGroupFile04"></label>
						      </div>
						    </div>
						</div>

						<br><br>

						<div class="row">
							<div class="col-md-12">
							<label>Menu Description</label>
								<textarea name="content_article" id="append_menu_category_description" class="form-control"></textarea>
								<script>
									CKEDITOR.replace( 'content_article' );
								</script>
							</div>
						</div>

					</div>
				</form>
		    	
		    		
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="btn_update_noun">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>

<br><br><br><br>
@endsection

