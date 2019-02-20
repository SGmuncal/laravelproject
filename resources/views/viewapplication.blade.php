@extends('layouts.adminnavbar')

@section('admin_content')
<form action="/updateapplication" method="post">
	@csrf
<br><br><br><br>

	<div class="container">
		
		<h2 style="font-weight: 400;">Application Update</h2>
		@if (Session::has('message'))
        	<li style="font-size:20px;">{!! session('message') !!}</li>
  		@endif
		<br><br>

		@foreach($application  as $value)
		@endforeach
		<input type="hidden" name="hid_id" value="{{$value->id}}">
		<div class="row">
			<div class="col-md-4">
				<label>Position</label>
				<input type="text" name="" value="{{$value->position_name}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Email</label>
				<input type="text" name="" value="{{$value->email}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Firstname</label>
				<input type="text" name="" value="{{$value->firstname}}" class="form-control">
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-4">
				<label>Last Name</label>
				<input type="text" name="" value="{{$value->lastname}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Middle Name</label>
				<input type="text" name="" value="{{$value->middlename}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Relocate</label>
				<input type="text" name="" value="{{$value->relocate}}" class="form-control">
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-4">
				<label>Starting Date</label>
				<input type="text" name="" value="{{$value->starting_date}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Phone Number</label>
				<input type="text" name="" value="{{$value->phonenumber}}" class="form-control">
			</div>
			<div class="col-md-4">
				<label>File</label>
				<br>
				<a href="{{url('/storage/'.$value->file_img_name.'')}}"><i class="fas fa-download fa-2x" style="color:#6a11cb;"></i></a>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-md-12">
				<label>Status</label>
				<select name="user_status" class="form-control">
					<option value="{{$value->Status}}" selected="">{{$value->Status}}</option>
					<option value="Pending">Pending</option>
					<option value="Assessment">Assessment</option>
					<option value="Examination">Examination</option>
					<option value="Interview">Interview</option>
					<option value="Department Interview">Department Interview</option>
					<option value="Approved">Approved</option>
					<option value="Reject">Reject</option>
				</select>
			</div>
		</div>

		<center>
			<div class="col-md-6">
		  		<br><br>
		  		<input class="btn btn-outline-primary btn-small form-control"  type="submit" value="Submit">
	  		</div>
		</center>
	</div>
</form>
@endsection