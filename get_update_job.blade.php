@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size: 14px;">
	<form action="/insert_update_job" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
	  	<div class="row">
	  		<div class="col-md-10">
				<h3>Job Update</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
			</div>
		</div>
	  	@if (Session::has('message'))
	      <li style="font-size:20px;">{!! session('message') !!}</li>
	 	@endif
	  	<br><br>
		@foreach($get_update_job_table as $value)
		  
		@endforeach

		<input type="hidden" name="hid_id" value="{{$value->id}}">

		
		<div class="row">
			<div class="col-md-6">
				<label>Position</label>
				<input type="text" name="position_name" class="form-control" value="{{$value->position_name}}">
			</div>
			<div class="col-md-6">
				<label>Location</label>
				<input type="text" class="form-control" name="location" value="{{$value->location}}">
			</div>
		</div>
		<br>
		<label>Status</label>
		<div class="row">
			<div class="col-md-6">
				<select name="job_status" class="custom-select" id="inputGroupSelect04">
				  	<option value="{{$value->status}}">{{$value->status}}</option>
	                @if($value->status == 'Inactive')

	                	<option value="Active">Active</option>
	                @else
	                	<option value="Inactive">Inactive</option>
	                @endif
         		</select>
			</div>
		</div>

	
		<br>
		
		<div class="row">
			<div class="col-md-6">
				<label>Position Description</label>
				<textarea name="postdescription" class="form-control">{{$value->position_desc}}</textarea>
				<script>
					CKEDITOR.replace( 'postdescription' );
				</script>

			</div>
			<div class="col-md-6">
				
				<label>Position Requirements</label>
				<textarea name="postrequirements" class="form-control">{{$value->position_requirements}}</textarea>
				<script>
					CKEDITOR.replace( 'postrequirements' );
				</script>
			</div>
		</div>



	</div>

</form>
</div>
<br><br><br>
@endsection