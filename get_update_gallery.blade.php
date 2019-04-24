@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size: 14px;">
	<form action="/insert_update_gallery" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
	  	<div class="row">
	  		<div class="col-md-10">
			<h3>Gallery Update</h3>
		</div>
		<div class="col-md-2">
			<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
		</div>
	  	</div>
	  
	  	@if (Session::has('message'))
	      <li style="font-size:20px;">{!! session('message') !!}</li>
	 	@endif
	  	<br><br>
		@foreach($get_table as $value)
		  
		@endforeach

		<input type="hidden" name="hid_id" value="{{$value->content_id}}">

		

		<div class="row">
			<div class="input-field col-md-6">
				<label>Header:</label>
		      <input placeholder="Header" id="first_name" type="text"  name="content_header"  class="validate form-control" aria-required="true" value="{{$value->content_title}}">
		    </div>
		    <div class="input-field col-md-6">
		    	<label>Event Place:</label>
		      <input placeholder="Event Place" id="first_name" type="text"  name="event_place"  class="validate form-control" aria-required="true" value="{{$value->event_place}}">
		    </div>
		</div>

		<br>

		

		<div class="row">
			<div class="input-field col-md-6">
	    	<label>Event Date:</label>
		      <input placeholder="Header" id="first_name" type="date"  name="event_date"  class="validate form-control" aria-required="true" value="{{$value->event_date}}">
		    </div>
		    <div class="col-md-6">
		    	<label>File:</label>
		      <div class="custom-file">
		        <input type="file" value="{{$value->file}}" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04">{{$value->file}}</label>
		      </div>
		    </div>
		</div>
		
		<br>
		<label>Status</label>
		<div class="row">
			<div class="input-group col-md-6">
			  <select name="gallery_status" class="custom-select" id="inputGroupSelect04">
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
				
			<div class="col-md-12">
				<label>Article:</label>
				<textarea name="content_article" name="content_article" placeholder="Article:" class="form-control">{{$value->content}}</textarea>
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