@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	<form action="/content_inserting_home" method="post" id="form" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Home Content</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
			</div>
		</div>
		@if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
		<br><br>
		<div class="row">
			<div class="col-md-6">
				<label>Choose the page</label>
				<select name="content_page"  class="form-control">
			      <option value="Home">Home</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Choose the selection</label>
				<select name="content_section" id="dropdown-home" class="form-control" required="">
			      <option selected="" disabled="" value="">Choose Section</option>
			      <option value="Mission">Mission</option>
			      <option value="Vision">Vision</option>
			      <option value="Career">Career</option>
			      <option value="Store">Store</option>
			    </select>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Header</label>
				<input placeholder="" name="content_header" class="form-control" id="title" type="text" class="validate">
			</div>

			<div class="col-md-6" id="link-content">
				<label>Link</label>
				<input placeholder="" name="button_link" id="link" class="form-control" type="text" class="validate">
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6" id="type-content">
				<label>Type</label>
				<select name="asset_type" class="form-control">
			      <option value="" disabled selected>Select type of file</option>
			      <option value="image">Image</option>
			    </select>
			</div>

			<div class="col-md-6" id="file-content">
			  <label>File:</label>
		      <div class="custom-file">	
		        <input type="file" value=""   name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>
		</div>
		<br><br>
		<div class="container">
			<div class="col-md-12">
				<textarea name="content_article" id="article" class="form-control"></textarea>
				<script>
					CKEDITOR.replace( 'content_article' );
				</script>
			</div>
		</div>
	</div>
</form>
</div>
<br><br><br><br>
@endsection

