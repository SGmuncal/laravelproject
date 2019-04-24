@extends('layouts.adminnavbar')
@section('admin_content')


<div class="jumbotron" style="background-color:#3366FF;">
	<h1 style="color:white; font-size: 55px; text-align: center;">New Menu Category</h1>
</div>

<form  method="post" enctype="multipart/form-data">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				{{-- <a class="btn btn-danger" style="color:white;"  id="btn-home-content"  value="Add Section" data-toggle="modal" data-target="#exampleModalCenter">Add Condiments</a> --}}
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-3">
				<input class="btn btn-primary form-control"  id="btn_menu_category_insert"  type="submit" value="Publish">
			</div>
		</div>

		<br><br>
		@if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
		<div class="row">
			<div class="col-md-6">
				<label>Choose Section</label>
				<select name="content_page"  class="form-control" id="menu_category_choices">
					<option disabled="" selected="true" value="">Menu Section</option>
			      @foreach($menu_choices as $choices)
			      	<option value="{{$choices->menu_id}}">{{$choices->menu_name}}</option>
			      @endforeach
			    </select>
			</div>

			<div class="col-md-6">
				<label>Menu Name</label>
				<input placeholder="" name="menu_category_name" class="form-control" id="menu_category_name" type="text" class="validate">
			</div>

		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Menu Price</label>
				<input type="number" name="menu_category_price" id="menu_category_price" class="currency form-control"  min="0.01" step="0.01" max="2500" value="0.00" />
			</div>
			<div class="col-md-6">
			  <label>Menu Image</label>
		      <div class="custom-file">	
		        <input type="file" value=""  name="file" class="custom-file-input form-control" id="menu_category_file">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
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
							<label>Menu Name</label>
							<input placeholder="For sharing..." name="menu_name_category" value="" class="form-control" id="menu_value" type="text" class="validate">
						</div>
						<div class="col-md-6">
						  <label>Menu Image</label>
					      <div class="custom-file">	
					        <input type="file" value=""  name="file" class="custom-file-input form-control" id="menu_file">
					        <label class="custom-file-label" for="inputGroupFile04"></label>
					      </div>
					    </div>
					</div>
		    	
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="save_menu_button">Save changes</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>


<br><br><br><br>
@endsection

