@extends('layouts.adminnavbar')

@section('admin_content')
<div class="container">
	<h3>Order Details</h3>
	<br>
</div>
@foreach($order_properties as $order1)
<div class="container">
	<div class="md-stepper-horizontal orange">
	    <div class="md-step active">
	      <div class="md-step-circle"><i class="far fa-check-circle"></i></div>
	      <div class="md-step-title">Processing</div>
	      <div class="md-step-bar-left"></div>
	      <div class="md-step-bar-right"></div>
	    </div>
	   {{--  <div class="md-step active">
	      <div class="md-step-circle"><span>3</span></div>
	      <div class="md-step-title"></div>
	      <div class="md-step-bar-left"></div>
	      <div class="md-step-bar-right"></div>
	    </div> --}}
	    @if($order1->delivery_status == 'Processing')
		    <div class="md-step">
		      <div class="md-step-circle"><i class="fas fa-truck"></i></div>
		      <div class="md-step-title">Delivered</div>
		      <div class="md-step-bar-left"></div>
		      <div class="md-step-bar-right"></div>
		    </div>
		@elseif($order1->delivery_status == 'Cancelled')

			<div class="md-step active">
		      <div class="md-step-circle"><i class="fas fa-ban"></i></div>
		      <div class="md-step-title">Delivered Cancelled</div>
		      <div class="md-step-bar-left"></div>
		      <div class="md-step-bar-right"></div>
		    </div>
		@elseif($order1->delivery_status == 'Delivered')
			<div class="md-step active">
		      <div class="md-step-circle"><i class="fas fa-truck"></i></div>
		      <div class="md-step-title">Delivered</div>
		      <div class="md-step-bar-left"></div>
		      <div class="md-step-bar-right"></div>
		    </div>
		@endif
	</div>
	<br><br>
	<div class="card">
	  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
	    <i class="fas fa-cart-arrow-down"></i> Order # {{$order1->or_number}}
	  </div>
	  <div class="card-body" style="font-size:14px; line-height: 9px;">
	     <div style="line-height:14px;">
 			<label><b>Total:</b> ${{$order1->amount}}</b></label><br>
 			<label><b>Order date:</b> {{$order1->order_date}}</label>
 		</div>
	  </div>
	</div>
	<br><br>
	<div class="card">
	  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
	    <i class="fas fa-cart-arrow-down"></i> Customer Orders
	  </div>
	  <table class="table table-hover">
		  <thead style="background: linear-gradient(25deg, #00e4d0, #5983e8); color:white; font-size:14px;">
		    <tr>
		      <th scope="col">Menu Image</th>
		      <th scope="col">Menu Name</th>
		      <th scope="col">Quantity</th>
		      <th scope="col" style="width:15%">Subtotal</th>
		    </tr>
		  </thead>

			@foreach($customer_order as $order2)

				<!-- compare two table value if same id -->
				@if($order2->order_properties_id == $order1->order_id)

					
				  <tbody style="font-size:15px;">
				    <tr style="">
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
</div>
<br>
@foreach($customer_details as $details)
@endforeach
@foreach($delivery_charge as $charge)
@endforeach
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <i class="fas fa-users" style="color:white;"></i> Personal Profile
			  </div>
			  <div class="card-body" style="font-size:14px; line-height: 9px;">
			    <label>{{$details->customer_name}}</label><br>
			    <label>{{$details->customer_email}}</label>
			    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
			    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
			  </div>
			</div>
			<br>
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(25deg, #00e4d0, #5983e8); color:white;">
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
		<br>
		<div class="col-md-6">
			<div class="jumbotron" style="background-color:white;">
				<div class="row">
     				<div class="col-md-5">
     					
     					<div class="cart-detail" style="font-size:14px;">
     						<label><b>Subtotal:</b></label><br>
		     				<label><b>Tax GST 5%:</b></label><br>
		     				<label><b>Delivery Charge $5</b></label>
		     				<hr>
		     				<label style="font-size: 20px;"><b>Total:</b></label>
     					</div>
     				</div>
     			
     				<br>
     				<div class="col-md-1"></div>
     				<div class="col-md-2"></div>
     				<div class="col-md-3">
     					<div class="cart-detail" style="font-size:14px; position: relative; left:15px;">
     						<label id="sub_total">{{$order1->subtotal}}</label><br>
     						
     						<label id="label_province_tax_rate">{{$order1->total_tax}}</label> <br>

     						
     						<label id="label_delivery_charge">{{$charge->charge_value}}</label>

     						<br><br>
     						<b><label id="total_price_label" style="font-size:20px;">{{$order1->amount}}</label></b>
     					</div>
     				</div>
     				
     			</div>
			</div>
		</div>
	</div>
</div>
@endforeach



<br><br><br><br>
@endsection