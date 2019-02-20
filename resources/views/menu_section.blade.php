@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
	<form action="/menu_inserting" method="post" id="form" enctype="multipart/form-data">
@csrf
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3>Menu Section</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
			</div>
		</div>
		<hr>
		@if (Session::has('message'))
	        <li style="font-size:20px;">{!! session('message') !!}</li>
	   @endif
		<br><br>
		<div class="row">
			<div class="col-md-6">
				<label>Choose the page</label>
				<select name="content_page"  class="form-control">
			      <option value="Delivery">Delivery</option>
			    </select>
			</div>

			<div class="col-md-6">
				<label>Choose the selection</label>
				<select name="content_section" id="dropdown-home" class="form-control" required="">
			      <option selected="" disabled="" value="">Choose Section</option>
			      <option value="Sharing">Sharing</option>
			      <option value="Forone">For One</option>
			      <option value="Deal">Deal</option>
			    </select>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-6">
				<label>Menu Name</label>
				<input placeholder="" name="content_header" class="form-control" id="title" type="text" class="validate">
			</div>
			<div class="col-md-6">
			  <label>Menu Image</label>
		      <div class="custom-file">	
		        <input type="file" value=""  name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04"></label>
		      </div>
		    </div>
		</div>
		<br><br>
		<div class="container">
			<div class="col-md-12">
				<label>Menu Description</label>
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

