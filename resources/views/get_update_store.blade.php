@extends('layouts.adminnavbar')

@section('admin_content')
<form action="/insert_update_store" method="post" enctype="multipart/form-data">
  @csrf
	<div class="container">
	  	<div class="row">
	  		<div class="col-md-10">
				<h3>Store Update</h3>
			</div>
			<div class="col-md-2">
				<input class="btn btn-outline-primary btn-small form-control" id="btn-home-content"  type="submit" value="Publish">
			</div>
		</div>
	  
	  	@if (Session::has('message'))
	      <li style="font-size:20px;">{!! session('message') !!}</li>
	 	@endif
	  	<br><br>
		@foreach($store_table as $value)
		  
		@endforeach

		<input type="hidden" name="hid_id" value="{{$value->id}}">

		
		<div class="row">
			<div class="col-md-6">
			  <label>City</label>
			  <select name="city" class="custom-select form-control" id="inputGroupSelect04">
			  	<option value="{{$value->city}}" selected>{{$value->city}}</option>
			    <option value="Winnipeg">Winnipeg</option>
			    <option value="Edmonton">Edmonton</option>
			    <option value="Calgary">Calgary</option>
              </select>
            </div>
          <div class="col-md-6">
          	<label>Header:</label>
	      	<input placeholder="Branch Store" required="" name="branch" id="first_name" type="text" class="validate form-control" value="{{$value->branch_name}}">
	      </div>
			
		</div>


		<br>
		
		<div class="row">
			@php 
			 $data =explode(',',$value->store_type);
			@endphp


			<div class="input-field col-md-6">
				<label>Store Type:</label>
				<select multiple name="store_type[]" required="" class="form-control">
				    <option value="Dine-in" {{in_array('Dine-in',$data)?'selected':''}}>Dine-in</option>
				    <option value="Take-out" {{in_array('Take-out',$data)?'selected':''}}>Take-out</option>
				    <option value="Home Delivery" {{in_array('Home Delivery',$data)?'selected':''}}>Home Delivery</option>
				    <option value="Drive Thru" {{in_array('Drive Thru',$data)?'selected':''}}>Drive Thru</option>
				</select>   
			</div>
			<div class="input-field col-md-6">
				<label>Store Code</label>
				<input placeholder="Store Code" required="" id="first_name" name="store_code" type="text" value="{{$value->store_code}}" class="validate form-control">
			</div>
		</div>

		

		<br>
		
		<div class="row">
			
			<div class="col-md-6">
				<label>Store Number</label>
				<input placeholder="Store Number" required="" id="first_name" name="store_number" type="text" value="{{$value->store_contactnumber}}" class="validate form-control">
			</div>
			<div class="col-md-6">
				<label>Store Address</label>
				<input placeholder="Store Address" value="{{$value->store_address}}"  required="" name="store_address" id="first_name" type="text" class="validate form-control">
			</div>
		</div>


	
		<br>
		
		<div class="row">
			<div class="input-field col-md-6">
				<label>Store Hour</label>
				<input placeholder="Store Business Hour" value="{{$value->store_businesshour}}" required="" name="store_hour" id="first_name" type="text" class="validate form-control">
			</div>
			<div class="input-field col-md-6">
				<label>Latitude</label>
				<input placeholder="Store Latitude" required="" name="lat" id="first_name" type="text" value="{{$value->store_lat}}" class="validate form-control">
			</div>
		</div>

		<br>
		
		<div class="row">
			<div class="input-field col-md-6">
				<label>Longitude</label>
				<input placeholder="Store Longitude" value="{{$value->store_long}}" required="" name="long" id="first_name" type="text" class="validate form-control">
			</div>
			<div class="col-md-6">
				<label>Status</label>
			  <select name="store_status" class="custom-select" id="inputGroupSelect04">
			  	<option value="{{$value->store_status}}">{{$value->store_status}}</option>
                @if($value->store_status == 'Inactive')

                	<option value="Active">Active</option>
                @else
                	<option value="Inactive">Inactive</option>
                @endif
                
              </select>
			</div>
		</div>

		
		<br>
		<label>File:</label>
		<div class="row">
			<div class="input-group col-md-6">
		      <div class="custom-file">
		        <input type="file" value="{{$value->image}}" name="file" class="custom-file-input form-control" id="inputGroupFile04">
		        <label class="custom-file-label" for="inputGroupFile04">{{$value->image}}</label>
		      </div>
		    </div>
		</div>

	</div>

</form>
<br><br><br><br>
@endsection