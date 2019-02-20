@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	<form action="/insert_update_slider" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
		<div class="row">
	  		<div class="col-md-10">
				<h3>Carousel Image Update</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
			</div>
		</div>
		
	    @if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
	   <br><br>
	   @foreach($table_slider as $value)
	   @endforeach
	   <input type="hidden" name="hid_id" value="{{$value->content_id}}">
		
		<div class="row">
			<div class="col-md-6">
				<label>Link</label>
		    	<input type="text" name="link" class="form-control" value="{{$value->link}}">
		    </div>
		    <div class="col-md-6">
				<label>File</label>
		      <div class="custom-file">
		      	<label>File:</label>
		        <input type="file" value="{{$value->file}}"  name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04">{{$value->file}}</label>
		      </div>
		    </div>
		</div>

		<label>Status</label>
		<div class="row">
			<div class="input-group col-md-6">
			  <select name="slider_status" class="custom-select" id="inputGroupSelect04">
			  	<option value="{{$value->status}}">{{$value->status}}</option>
                @if($value->status == 'Inactive')

                	<option value="Active">Active</option>
                @else
                	<option value="Inactive">Inactive</option>
                @endif
                
              </select>
			</div>
		</div>

		
	</div>
</form>
</div>
<br><br><br><br>
@endsection