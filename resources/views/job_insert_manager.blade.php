@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	<form action="/content_inserting_job" method="post">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Job Content</h3>
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
			<div class="col-md-6" id="link-content">
				<label>Position Name</label>
				<input placeholder="" name="postname" id="title" required="required" type="text" class="form-control">
			</div>
			<div class="col-md-6">
				<label>Location</label>
				<input placeholder="" name="location" id="title" required="required" type="text" class="form-control">
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Position Description</label>
				
				<textarea name="postdescription" required="required" class="form-control"></textarea>
				<script>
					CKEDITOR.replace( 'postdescription' );
				</script>
			</div>

			<div class="col-md-6" id="link-content">
				<label>Position Requirements</label>
				<textarea name="postrequirements" required="required" class="form-control"></textarea>
				<script>
					CKEDITOR.replace( 'postrequirements' );
				</script>
			</div>
		</div>
	</div>
</form>
</div>
<br><br><br><br>
@endsection