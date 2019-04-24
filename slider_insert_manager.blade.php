@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size: 14px;">
	<form action="/content_inserting_slider" method="post" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Slider Content</h3>
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
				<label>Choose the page</label>
				<select name="content_page"  class="form-control" required="">
			      <option value="Slider">Slider</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Link</label>
				<input type="text" name="slider_link" class="form-control">
			</div>
		</div>

		<br><br>

		<div class="row">

			<div class="col-md-6">
				<label>Active Image</label>
				<select name="active_image" class="form-control">
					<option value="0">Inactive</option>
					<option value="1">Active</option>
				</select>
			</div>

			<div class="col-md-6" id="file-content">
			  <label>File:</label>
		      <div class="custom-file">	
		        <input type="file" value="" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>

		</div>
		
	</div>
</form>
</div>
@endsection