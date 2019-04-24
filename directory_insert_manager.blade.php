@extends('layouts.adminnavbar')

@section('admin_content')
<form action="/content_inserting_directory" method="post" enctype="multipart/form-data">
@csrf

	<div class="jumbotron" style="background-color:white; font-size: 14px;">
		<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Home Content</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="hoverButton"  type="submit" value="Publish">
			</div>
		</div>
		@if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
		<br><br>
		<div class="row">
			<div class="col-md-6">
				<label>Province</label>
				<select name="city" required="" id="dropdown-home" class="form-control" required="">
			      <option value="" disabled selected>Choose your option</option>
			      <option value="Winnipeg">Winnipeg</option>
			      <option value="Edmonton">Edmonton</option>
			      <option value="Calgary">Calgary</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Store Type</label>
				<select id="store_type" multiple name="store_type[]" required="" class="form-control">
			      <option value="" disabled selected>Choose your option</option>
			      <option value="Dine-in">Dine-in</option>
			      <option value="Take-out">Take-out</option>
			      <option value="Home Delivery">Home Delivery</option>
			      <option value="Drive Thru">Drive Thru</option>
			    </select>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Branch</label>
				<input placeholder="" name="branch" class="form-control" id="title" type="text" class="validate">
			</div>

			<div class="col-md-6">
				<label>Code</label>
				<input placeholder="" name="store_code" class="form-control" type="text" class="validate">
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Store Contact Number</label>
				<input placeholder="" name="store_number" id="link" class="form-control" type="text" class="validate">
			</div>

			<div class="col-md-6">
			  <label>Address</label>
				<input placeholder="" name="store_address"  class="form-control" type="text" class="validate">
		    </div>
		</div>


		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Store Business Hour</label>
				<input placeholder="" name="store_hour"  class="form-control" type="text" class="validate">
			</div>

			<div class="col-md-6">
			  <label>Latitude</label>
				<input placeholder="" name="lat"  class="form-control" type="text" class="validate">
		    </div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Longitude</label>
				<input placeholder="" name="long" class="form-control" type="text" class="validate">
			</div>

			<div class="col-md-6">
			  <label>Store Image</label>
		      <div class="custom-file">	
		        <input type="file" value=""  name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>
		</div>
		
	</div>
	</div>
</form>
<br><br><br><br><br><br>
@endsection