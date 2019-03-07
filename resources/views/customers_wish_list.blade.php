@extends('layouts.adminnavbar')

@section('admin_content')
@foreach($customer_details as $customer_detail)
@endforeach

@foreach($delivery_charge as $charge)
@endforeach

@foreach($get_tax as $tax)
@endforeach

<div class="container">

	<div class="row">
		<div class="col-md-4">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <i class="fas fa-users"></i> Personal Profile
			  </div>
			  <div class="card-body">
			    <label>{{$customer_detail->customer_name}}</label><br>
			    <label>{{$customer_detail->customer_email}}</label>
			  </div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			     <i class="fas fa-address-card"></i> Default Shipping Address
			  </div>
			  <div class="card-body">
			    <label></label>
			    <label>{{$customer_detail->customer_name}}</label>
			    <div style="font-size:14px; line-height: 9px;">
			    	<label>{{$customer_detail->customer_address}}</label><br>
			    	<label>{{$customer_detail->customer_number}}</label>
			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <i class="fas fa-truck"></i> Delivery Charge
			  </div>
			  <div class="card-body">
			    <p><i class="fas fa-check"></i> <b>${{$charge->charge_value}}</b></p>
			    <br>
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
				<h4><i class="fab fa-opencart"></i> On Proccess Cart</h4>
			</div>
		</div>
		<hr>
		@foreach($wish_list_menu_order as $wish_list_order)

			
			<div class="row">

				<div class="col-md-11">

					<p style="font-weight: bold;" class="total_wish_order" data-attribute-wish-order-id='{{$wish_list_order->wish_menu_id}}'>{{$wish_list_order->wish_list_menu_name}} <br></p>

					@foreach($wish_list_menu_belong_condiments as $wish_menu_condiments)

						@if($wish_menu_condiments->wish_menu_id == $wish_list_order->wish_menu_id)
							&nbsp;&nbsp;&nbsp;<label>{{$wish_menu_condiments->belong_condi_qty}}x {{$wish_menu_condiments->belong_condi_name}}</label><br>
						@endif

					@endforeach
					
				</div>

				<div class="col-md-1">
					<i class="far fa-trash-alt remove_wish_order" data-attribute-delete-wish-order='{{$wish_list_order->wish_menu_id}}' style="cursor: pointer; color:#007BFF;"></i><br><br>
					<label style="font-weight: bold;" class="compute_order_prices">${{$wish_list_order->wish_list_total_price}}</label>
				</div>

			</div>

			<hr>


			
		@endforeach

			<div class="d-flex">
				
				<div>
					<h3 style="font-weight: bold;">Items<br></h3>
					<h3 style="font-weight: bold;">Subtotal:<br></h3>
					<br>
					<label>Tax:</label><br>
					<label>Delivery Charge:</label><br>
					<label style="font-weight: bold;">Total:</label><br>

				</div>

				<div class="ml-auto">
					<h3 style="font-weight: bold;" class="total_order_count"><br></h3>
					<h3 style="font-weight: bold;" class="total_wish_sub_total"><br></h3>
					<br>
					<input type="hidden" value="{{$tax->value}}" class="tax_rate" name="">
					<label class="total_tax_rate_computation"></label><br>
					<label class="delivery_rate">${{$charge->charge_value}}</label><br>
					<label class="total_price_label"  style="font-weight: bold;"></label><br>
				</div>
			</div>

			
		
		<br><br><br>
		<center>
			<div class="col-md-6">
				<button class="btn btn-primary form-control" id="btn_order_peroperties" style="height:50px;">Proceed to processing</button><br><br>
				<button class="btn btn-outline-danger form-control" style="height:50px;">Add More Food</button><br>
			</div>
		</center>
	</div>
</div>

<br><br><br><br>
@endsection