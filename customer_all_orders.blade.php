@extends('layouts.adminnavbar')

@section('admin_content')
@foreach($customer_details as $details)
@endforeach
<div class="container">
	<h3>Manage Account</h3>
	<br>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
			  <div class="card-header">
			    <i class="fas fa-users"></i> Personal Profile
			  </div>
			  <div class="card-body"  style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <label>{{$details->customer_name}}</label><br>
			    <label>{{$details->customer_email}}</label>
			  </div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
			  <div class="card-header">
			     <i class="fas fa-address-card"></i> Default Shipping Address
			  </div>
			  <div class="card-body"  style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <label>{{$details->customer_name}}</label>
			    <div style="font-size:14px; line-height: 9px;">
			    	<label>{{$details->customer_address}}</label><br>
			    	<label>{{$details->customer_number}}</label>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>

<br><br>

<div class="container">
	<div class="jumbotron" style="background-color:white;">
		<div class="row">
			<div class="col-md-3">
				<h3>Search Order #</h3>
			</div>
		</div>
		<br><br>	
		<div class="table-responsive" style="">
		    
		    <table id="tables_customer_details" class="table table-striped table-bordered" style="width:100%;">
		        <thead>
		            <tr style="background-color:none !important; border-style:hidden !important; font-size: 14px; ">
		            	<th>Order Number</th>
		                <th scope="col">Customer Name</th>
		                <th scope="col">Customer Number</th>	
		                <th scope="col">Customer Address</th>
		                <th scope="col">Customer Store Location</th>
		                <th>Order Status</th>
		                <th scope="col">Action</th>
		            </tr>
		        </thead>
		        <tbody style=" font-size:14px;">
		        	
		        	
	        		@if(Auth::user())
	        			@foreach($get_customer_details as $detail)
			        		<tr>
			        			<td>{{$detail->order_number}}</td>
				                <td>{{$detail->customer_name}}</td>
				                <td>{{$detail->customer_number}}</td>
				                <td>{{$detail->customer_address}}</td>
				                <td>{{$detail->customer_location}}</td>
				                <td>{{$detail->delivery_status}}</td>
				              
				                 <td><a class="btn btn-primary" id="view_order" href="/order_detail/{{$detail->customer_id}}/{{$detail->order_id}}"><i class="fas fa-eye"></i></a></td>


				            </tr>
			        	@endforeach
	        		@endif
			        	

		        </tbody>
		    </table>
	    </div>
        <br>
	</div>
</div>

<br><br><br><br>
@endsection