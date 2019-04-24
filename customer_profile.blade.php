@extends('layouts.adminnavbar')

@section('admin_content')
@foreach($customer_details as $details)
@endforeach


<h3>Manage Account</h3>
<br>
<div class="row">
	<div class="col-md-4">
		<div class="card">
		  <div class="card-header">
		    <i class="fas fa-users"></i> Personal Profile
		  </div>
		  <div class="card-body" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; font-weight:300;">
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
		  <div class="card-body" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; font-weight: 300;">
		    <label>{{$details->customer_name}}</label>
		    <div style="font-size:14px; line-height: 9px;">
		    	<label>{{$details->customer_address}}</label><br>
		    	<label>{{$details->customer_number}}</label>
		    </div>
		  </div>
		</div>
	</div>
</div>


<br><br>

	<div class="jumbotron" style="background-color:white;">
		<div class="row">
			<div class="col-md-6">
				<h5>Recent Orders Transaction</h5>
			</div>
			<div class="col-md-6">
				<a href="/customer_all_orders/{{$details->customer_id}}" class="btn btn-primary float-right" id="all_orders" href="">All Orders</a>
			</div>
		</div>
        <br>
        	@foreach($select_delivery_charge as $del_charge)
        	@endforeach
        	<div class="jumbotron">
        		@foreach($order_properties as $order_propertie)

        		

        		<hr><br><br>
        		<div class="row">

        			<div class="col-md-9">
						<div style="line-height: 8px;">
							<p style="font-weight: bold;">#{{$order_propertie->or_number}} <br></p>
							<p>{{$order_propertie->order_ship_address}}</p>
						</div>
					</div>
					<div class="col-md-3">
						<label style="font-size:14px; font-weight: bold;">{{$order_propertie->order_date}}</label>	
						<div class="progress">
						  <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"> 100% {{$order_propertie->delivery_status}}</div>
						</div>	
					</div>

        		</div>
        		<br>
        		<h4>Your Ordered</h4>

        		
        		<!--ITEM HERE -->

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

	    		@foreach($payment as $pay)
					@if( $order_propertie->order_id == $pay->order_id )
						<div class="jumbotron">
							<div class="row">
								<div class="col-md-11">
									<p>Sub-Total</p>
									<p>Tax</p>
									<p>Delivery Charge</p>
									<p>TOTAL</p>
								</div>
								<div class="col-md-1" style="font-weight: bold;">
									<label>${{$pay->subtotal}}</label>
									<label>${{$pay->total_tax}}</label>
									<label>${{$del_charge->charge_value}}</label>
									<label>${{$pay->amount}}</label>
								</div>
							</div>
						</div>
					@endif
				@endforeach
        		

        	@endforeach
        	</div>

<!-- 		@foreach($wish_list_menu_order as $wish_list_order)

		
			<div class="row">

				<div class="col-md-11">

					<p style="font-weight: bold;" class="total_wish_order get_wish_order_id" data-attribute-wish-order-id='{{$wish_list_order->wish_menu_id}}'>{{$wish_list_order->wish_list_menu_name}} <br></p>

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
		@endforeach -->
	</div>


<br><br><br><br>
@endsection