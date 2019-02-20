@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	<form action="/content_inserting_gallery" method="post" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<a href="{{ url('gallery_album_insert_manager') }}" style="color:black; text-decoration: none;"><h3>Gallery Preview Content > Upload Gallery Images </h3></a>
			</div>
				
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control"  type="submit" value="Publish">
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
			      <option value="Gallery">Gallery</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Album Name</label>
				<input placeholder="" name="content_header" class="form-control" id="title" type="text" class="validate">
			</div>

		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Event Date</label>
				<input type="date" name="event_date" class="form-control">
			</div>

			<div class="col-md-6">
				<label>Event Place</label>
				<input placeholder="" name="event_place" class="form-control" type="text" class="validate">
			</div>

		</div>

		<br><br>

		<div class="row">


			<div class="col-md-6" id="file-content">
			  <label>File:</label>
		      <div class="custom-file">	
		        <input type="file" value="" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>

			
			<div class="col-md-6">
				<label>Type</label>
				<select name="asset_type" class="form-control">
			      <option value="" disabled selected>Select type of file</option>
			      <option value="image">Image</option>
			    </select>
			</div>

		</div>
		
	</div>
</form>
</div>
<br><br><br><br>
@endsection