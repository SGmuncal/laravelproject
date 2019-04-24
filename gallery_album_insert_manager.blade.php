@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size:14px;">
	<form action="/gallery_album_insert" method="post" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<a href="/gallery_insert_manager" style="color:black; text-decoration: none;"><h3>Gallery Preview Content < Upload Gallery Images </h3></a>
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
			      <option value="Gallery">Gallery</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Albums</label>
				<select name="album_name" id="dropdown-home" class="form-control" required="">
			      @foreach($album as $get_album)
			      	<option value="{{$get_album->content_id}}">{{$get_album->content_title}}</option>
			      @endforeach
			    </select>
			</div>

		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6" id="file-content">
			  <label>File:</label>
		      <div class="custom-file">	
		        <input type="file" value="" name="file[]" class="custom-file-input form-control" id="inputGroupFile04" multiple="">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>		
		</div>
		
	</div>
</form>
</div>
@endsection