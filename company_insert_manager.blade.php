@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size:14px;">
	<form action="/content_inserting_history" method="post" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Company Content</h3>
			</div>
				
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id='hoverButton' type="submit" value="Publish">
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
			      <option value="History">History</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Choose type</label>
				<select name="content_section" required="" class="form-control">
			      <option value="Left">Left</option>
			      <option value="Right">Right</option>
			    </select>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Year</label>
				 <input type="text"  name="content_year" class="form-control">
			</div>
		</div>
		
		<br><br>
		<div class="container">
			<div class="col-md-12">
				<textarea name="content_article" class="form-control"></textarea>
				<script>
					CKEDITOR.replace( 'content_article' );
				</script>
			</div>
		</div>
	</div>
</form>
</div>
@endsection