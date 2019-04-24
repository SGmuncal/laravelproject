@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white;">
	<form action="/insert_gallery_image" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
		<h2 style="font-weight: 400;">Gallery Images Update</h2>
		
	    @if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
	   <br><br>
	   @foreach($get_update_image as $value)
	   @endforeach
	   <input type="hidden" name="hid_id" value="{{$value->id}}">
	   <center>
	   	<br><br><br>
		
			<div class="input-group col-md-6">

		      <div class="custom-file">
		      	<label>File:</label>
		        <input type="file" value="{{$value->image}}" required="" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04">{{$value->image}}</label>
		      </div>
		    </div>

			<div class="col-md-6">
		  		<br>
		  		<input class="btn btn-outline-primary btn-small form-control" id="hoverButton" type="submit" value="Submit">
	  		</div>
		
		</center>
	</div>
</form>
</div>
@endsection