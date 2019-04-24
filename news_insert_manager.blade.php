@extends('layouts.adminnavbar')

@section('admin_content')
<form action="/content_inserting_news" method="post" enctype="multipart/form-data">
@csrf
	<div class="jumbotron" style="background-color:white; font-size:14px;">
		<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>News Content</h3>
			</div>
				
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="hoverButton" type="submit" value="Publish">
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
			      <option value="News">News</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Header</label>
				<input placeholder="" name="content_header" class="form-control" id="title" type="text" class="validate">
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

			
			<div class="col-md-6">
				<label>Type</label>
				<select name="asset_type" class="form-control">
			      <option value="" disabled selected>Select type of file</option>
			      <option value="image">Image</option>
			    </select>
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
	</div>
</form>
<br><br><br><br><br>
@endsection