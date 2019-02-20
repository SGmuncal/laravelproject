@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	
<form action="/insert_news_image" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
		<h2 style="font-weight: 400;">News Images Update</h2>
		<br><br>
	    @if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
	   @foreach($update_image as $value)
	   @endforeach
	   <input type="hidden" name="hid_id" value="{{$value->id}}">
	   <center>
	   	<br>
		
			<div class="input-group col-md-6">

		      <div class="custom-file">
		      	<label>File:</label>
		        <input type="file" value="{{$value->file}}" required="" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04">{{$value->file}}</label>
		      </div>
		    </div>

			<div class="col-md-6">
		  		<br>
		  		<input class="btn btn-outline-primary btn-small form-control"  type="submit" value="Publish">
	  		</div>
		
		</center>
	</div>
</form>
</div>
@endsection