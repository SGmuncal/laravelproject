@extends('layouts.adminnavbar')

@section('admin_content')
@foreach($customer_details as $details)
@endforeach
<div class="container">
	<h3>Manage Account</h3>
	<br>
	<div class="row">
		<div class="col-md-4">s
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <i class="fas fa-users"></i> Personal Profile
			  </div>
			  <div class="card-body">
			    <label>{{$details->customer_name}}</label><br>
			    <label>{{$details->customer_email}}</label>
			    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
			    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
			  </div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			     <i class="fas fa-address-card"></i> Default Shipping Address
			  </div>
			  <div class="card-body">
			    <label>{{$details->customer_name}}</label>
			    <div style="font-size:14px; line-height: 9px;">
			    	<label>{{$details->customer_address}}</label><br>
			    	<label>{{$details->customer_number}}</label>
			    </div>
			   {{--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
			    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
			  </div>
			</div>
		</div>
	</div>
</div>

<br><br>

<div class="container">
	<div class="jumbotron" style="background-color:white;">
		<div class="row">
			<div class="col-md-6">
				<h5>Recent Orders Transaction</h5>
			
			</div>
			<div class="col-md-6">
				<a href="/customer_all_orders/{{$details->customer_id}}" class="btn btn-primary float-right" href="" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); border-color:transparent;">All Orders</a>
			</div>
			
		</div>
        <br>
	 	@foreach($order_properties as $order1)

	 			<hr>
	 			
		 		<div class="order_details">
		 			<!-- Logic to get single value of order number -->
			 		<div style="line-height:14px;">
			 			<label style="font-weight: 600;">Order #:{{$order1->or_number}} </label><a href="/order_detail/{{$order1->customer_id}}/{{$order1->order_id}}" class="float-right" >Manage</a><br>
			 			<label style="font-size:14px;">Place on: {{$order1->order_date}}</label>
			 		</div>
			 		<br><br>

			 		<table class="table table-hover">
					  <thead style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; color:white; font-size:14px;">
					    <tr>
					      <th scope="col">Menu Image</th>
					      <th scope="col">Menu Name</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Subtotal</th>
					    </tr>
					  </thead>

			 		@foreach($customer_order as $order2)

			 			<!-- compare two table value if same id -->
		 				@if($order2->order_properties_id == $order1->order_id)

		 					
							  <tbody style="font-size:14px;">
							    <tr>
							     	<td><img src="{{url('/storage/'.$order2->menu_cat_image.'')}}" class="responsive-img" style="width:100px;"></td>

							     	<td><br>{{$order2->menu_cat_name}}</td>
							     	<td><br>{{$order2->Quantity}}</td>
							     	<td><br>${{$order2->Subtotal}}</td>
							    </tr>
							  </tbody>
					
		 				  	
		 				@endif
		 					
			 		@endforeach
			 		</table>
		 		</div>

	 	@endforeach
        
	</div>
</div>

<br><br><br><br>
@endsection