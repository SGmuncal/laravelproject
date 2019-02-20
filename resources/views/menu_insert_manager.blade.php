@extends('layouts.adminnavbar')
<style>
	tbody {
	    overflow-y: scroll;
	    overflow-x: hidden;
	    height: 140px;
	}
	td, th {
	    border: dashed 1px lightblue;
	    overflow:hidden;
	    text-overflow: ellipsis;
	}
</style>
@section('admin_content')


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" id="tables" style="overflow-x: scroll;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Menu Name</th>
              <th>Menu Description</th>
              <th>Menu Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
	            <tr>
	              <td>1</td>
	              <td>Anna</td>
	              <td>Pitt</td>
	              <td>35</td>
	              <td>New York</td>
	              
	            
	            </tr>
	            <tr>
	              <td>1</td>
	              <td>Anna</td>
	              <td>Pitt</td>
	              <td>35</td>
	              <td>New York</td>
	              
	            </tr>
	            <tr>
	              <td>1</td>
	              <td>Anna</td>
	              <td>Pitt</td>
	              <td>35</td>
	              <td>New York</td>
	              
	            </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>




<!-- <div class="jumbotron" style="background-color:#3366FF;">
	<h1 style="font-size: 55px; text-align: center; color:white;">New Menu</h1>
</div> -->

<!-- <form  method="post" enctype="multipart/form-data">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<a class="btn btn-danger" style="color:white;"  id="btn-home-content"  value="Add Section" data-toggle="modal" data-target="#exampleModalCenter">Add Menu Section</a>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-3">
				<input class="btn btn-primary form-control"  id="btn_menu_insert"  type="submit" value="Publish">
			</div>
		</div>

		<br><br>
		
		<div class="row">
			<div class="col-md-6">
				<label>Choose the page</label>
				<select name="content_page"  class="form-control" id="menu_section_choices">
					<option disabled="" selected="true" value="">Menu Section</option>
			      @foreach($menu_section_choices as $choices)
			      	<option value="{{$choices->menu_sec_id}}">{{$choices->menu_sec_name}}</option>
			      @endforeach
			    </select>
			</div>

		{{-- 	<div class="col-md-6">
				<label>Choose the selection</label>
				<select name="content_section" id="dropdown-home" class="form-control" required="">
			      <option selected="" disabled="" value="">Choose Section</option>
			      <option value="Sharing">Sharing</option>
			      <option value="Forone">For One</option>
			      <option value="Deal">Deal</option>
			    </select>
			</div> --}}
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
</form> -->


<br><br><br><br>
@endsection

