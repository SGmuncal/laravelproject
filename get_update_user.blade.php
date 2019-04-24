@if(Auth::user()->role == '1')
<script type="text/javascript">
     window.location = "{{ url('/hiflyerdashboard') }}";
</script>
@endif

@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white;">
	<form action="/insert_update_user" method="post">
  @csrf
	<div class="container">
	  	<h3>User Update</h3>
	  
	  	@if (Session::has('message'))
	      <li style="font-size:20px;">{!! session('message') !!}</li>
	 	@endif
	  	<br><br>
		@foreach($update_user as $get_user)
		  
		@endforeach

		<input type="hidden" name="hid_id" value="{{$get_user->id}}">

		

		<div class="row">
			<div class="col-md-6">
				<label>Name</label>
		      <input placeholder="Name" id="first_name" type="text"  name="user_name"  class="validate form-control" aria-required="true" value="{{$get_user->name}}">
		    </div>
		    <div class="col-md-6">
		    		<label>Role</label>
			  	<select name="user_role" class="custom-select form-control" id="inputGroupSelect04">
				  	<option value="{{$get_user->role}}">

				  		 @if($get_user->role == '2')
				  		 	Administrator
				  		 @elseif($get_user->role == '1')
				  		 	Content Manager
				  		 @else
				  		 	Store Manager
				  		 @endif

				  	</option>

	                @if($get_user->role == '2')

	                	<option value="1">Content Manager</option>
	                @else
	                	<option value="2">Administrator</option>
	                @endif
                
              </select>
			</div>
		</div>


		<br>
		
		<div class="row">
			<div class="col-md-6">
	    	 <label>Email</label>
		      <input placeholder="Email" id="first_name" type="email"  name="user_email"  class="validate form-control" aria-required="true" value="{{$get_user->email}}">
		    </div>
		    <div class="input-field col-md-6">
	    		<label>Password</label>
		      <input placeholder="Password" id="first_name" type="password"  name="user_password"  class="validate form-control" aria-required="true" value="{{$get_user->password}}">

		    </div>
		</div>

	
		<br>
		<label>Status</label>
		<div class="row">
			<div class="input-group col-md-6">
			  <select name="user_status" class="custom-select" id="inputGroupSelect04">
			  	<option value="{{$get_user->status}}">{{$get_user->status}}</option>
                @if($get_user->status == 'Inactive')

                	<option value="Active">Active</option>
                @else
                	<option value="Inactive">Inactive</option>
                @endif
                
              </select>
			</div>
		</div>


		<div class="row">
			<div class="col-md-6">
		  		<br><br>
		  		<input class="btn btn-outline-primary btn-small form-control" id="hoverButton" type="submit" value="Submit">
	  		</div>
		</div>

	</div>

</form>
</div>
<br><br><br><br>
@endsection