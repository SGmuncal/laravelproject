@extends('layouts.adminnavbar')

@section('admin_content')
<div class="container">
	<h3>Order Details</h3>
	<br>
</div>

@foreach($order_properties as $order_propertie)
	<div class="container">
		<div class="md-stepper-horizontal orange">
		    <div class="md-step active">
		      <div class="md-step-circle"><i class="far fa-check-circle"></i></div>
		      <div class="md-step-title">Processing</div>
		      <div class="md-step-bar-left"></div>
		      <div class="md-step-bar-right"></div>
		    </div>
		    @if($order_propertie->delivery_status == 'Processing')
			    <div class="md-step">
			      <div class="md-step-circle"><i class="fas fa-truck"></i></div>
			      <div class="md-step-title">Delivered</div>
			      <div class="md-step-bar-left"></div>
			      <div class="md-step-bar-right"></div>
			    </div>
			@elseif($order_propertie->delivery_status == 'Cancelled')

				<div class="md-step active">
			      <div class="md-step-circle"><i class="fas fa-ban"></i></div>
			      <div class="md-step-title">Delivered Cancelled</div>
			      <div class="md-step-bar-left"></div>
			      <div class="md-step-bar-right"></div>
			    </div>
			@elseif($order_propertie->delivery_status == 'Completed')
				<div class="md-step active">
			      <div class="md-step-circle"><i class="fas fa-truck"></i></div>
			      <div class="md-step-title">Delivered</div>
			      <div class="md-step-bar-left"></div>
			      <div class="md-step-bar-right"></div>
			    </div>
			@endif
		</div>
		<br><br>
		@foreach($payment as $pay)
			@if($pay->order_id == $order_propertie->order_id)
				<div class="card">
				  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
				    <i class="fas fa-cart-arrow-down"></i> Order # {{$pay->order_number}}
				  </div>
				  <div class="card-body" style="font-size:14px; line-height: 9px;">
				     <div style="line-height:14px;">
			 			<label><b>Total:</b> ${{$pay->amount}}</b></label><br>
			 			<label><b>Order date:</b> {{$order_propertie->order_date}}</label>
			 		</div>
				  </div>
				</div>
			@endif
		@endforeach
		<br><br>
		<div class="card">
		  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
		    <i class="fas fa-cart-arrow-down"></i> Customer Orders
		  </div>
		</div>
		@foreach($order_details_properties as $order_detail)
			@if($order_detail->order_properties_id == $order_propertie->order_id)
				@foreach($wish_list_menu_order as $wish_list_menu)
					@if($wish_list_menu->wish_menu_id == $order_detail->product_id)
						<hr>
						<div>
							
							<img src="{{url('/storage/'.$wish_list_menu->menu_cat_image.'')}}" class="responsive-img" style="width:200px;">

							<p style="font-weight: bold;">{{$wish_list_menu->wish_list_menu_name}}</p>
							<label>{!!$wish_list_menu->menu_cat_desc!!}</label>
							<br><br>
							@foreach($wish_list_menu_belong_condiments as $condiments)
						
								@if($condiments->wish_menu_id == $wish_list_menu->wish_menu_id)
									&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight: 300; font-size:15px;">x{{$condiments->belong_condi_qty}} {{$condiments->belong_condi_name}}</label><br>
								@endif

							@endforeach
						</div>

					@endif
				@endforeach
			@endif
		@endforeach
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
		     						<label id="sub_total">{{$pay->subtotal}}</label><br>
		     						
		     						<label id="label_province_tax_rate">{{$pay->total_tax}}</label> <br>

		     						
		     						<label id="label_delivery_charge">{{$charge->charge_value}}</label>

		     						<br><br>
		     						<b><label id="total_price_label" style="font-size:20px;">{{$pay->amount}}</label></b>
		     					</div>
		     				</div>
		     				<button class="form-control btn btn-primary" onclick="printOrderDetail()">Print Order</button>
		     			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach

<br><br><br><br>
@endsection