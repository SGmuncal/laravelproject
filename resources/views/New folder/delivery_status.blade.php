@extends('layouts.adminnavbar')

@section('admin_content')

<div class="container">
	
		<div class="col-md-12">
			<h3>Monitor Delivery Status</h3>		
		</div>
	
</div>
<br><br>
<div class="container">

	
		<div class="row">
			<div class="col-md-3">
				<div id="launchPad" style="overflow-y: scroll; height:700px;">
					<div class="stackHdr" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; text-align: center; width:236px;">
				        <text>Open Orders</text>
				    </div>    
					@foreach($customer_orders_details as $transac_details)
						@if($transac_details->delivery_status == 'Processing')
							<div class="drag-wrapper from-launch" >
							    <div class="card addStyleHover" style="opacity: 0.8">
							        <div class="card-body" style="font-weight: bold; text-align: center;" >
							            <h5 class="card-title" style="text-align: center;">
							                <i class="far fa-user-circle" style="font-size:30px;"></i>
							                <br><br>
							                <h6 class="card-subtitle mb-2 text-muted numbers" style="font-weight: 300; color:black !important; font-family: 'Open Sans';">OR # {{$transac_details->or_number}}</h6>

							                <h6 class="card-subtitle mb-2 text-muted" style="font-weight: bold; color:black !important;">Customer: {{$transac_details->customer_name}}</h6>
							                <h6 class="card-subtitle mb-2 text-muted" style="color:black !important;">Driver: {{$transac_details->driver_name}}</h6><br>
							                <h6 class="card-subtitle mb-2 text-muted" style="font-weight: 300;">Address: {{$transac_details->order_ship_address}}</h6>
							                <h6 class="card-subtitle mb-2 text-muted" style="font-weight: 300;">Contact #: {{$transac_details->customer_number}}</h6>
							                <p class="card-text">Total:${{$transac_details->amount}}</p>

							                <input type="hidden" name="" class="or_number" value="{{$transac_details->or_number}}">

							                @if($transac_details->driver_name != "")
							                @else
							                    <button href="#" data-order-id='{{$transac_details->order_id}}' data-customer-id='{{$transac_details->customer_id}}' style="" data-toggle="modal" data-target="#driver_assign" type="button" class="card-link btn btn-primary assign_btn">Assign</button>
							                @endif

							                <button href="#" class="card-link btn btn-outline-warning gather_customer_order" data-order-id='{{$transac_details->order_id}}' data-customer-id='{{$transac_details->customer_id}}' style="" data-toggle="modal" data-target="#customer_detail_delivery">Details</button>

							            </h5>
							        </div>
							    </div>
							</div>
						
						@endif
					@endforeach
				</div>
			</div>
			<div class="col-md-3">
				<div id="dropZone">
				    <div class="stack"  style="width:260px;">
				        <div class="stackHdr" style="background: linear-gradient(-10deg, #00e4d0, #5983e8); color:white;  text-align: center;">
				            <text>In the Kitchen</text>
				        </div>
				        <center>
				        	<div class="stackDrop1" id="drop2" style="">
				            	 
				        	</div>
				        </center>
				    </div>
				</div>
			</div>
			<div class="col-md-3">
				<div id="dropZone">
				    <div class="stack"  style="width:260px;">
				        <div class="stackHdr" style="background: linear-gradient(-10deg, #00e4d0, #5983e8); color:white;  text-align: center;">
				            <text>On the Road</text>
				        </div>
				        <center>
				        	<div class="stackDrop2" style="">
				            	
				        	</div>
				        </center>
				    </div>
				</div>
			</div>
			<div class="col-md-3">
				<div id="dropZone">
				    <div class="stack"  style="width:260px;">
				        <div class="stackHdr" style="background: linear-gradient(-10deg, #00e4d0, #5983e8); color:white;  text-align: center;">
				            <text>Completed</text>
				        </div>
				        <center>
				        	<div class="stackDrop3" style="">
				            	
				        	</div>
				        </center>
				    </div>
				</div>
			</div>
		</div>


</div>


<!--add product -->
<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="customer_detail_delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="container-fluid">
			<div class="modal-dialog modal-lg float-right" role="document" style="width:60%;">
				<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Order Details <b># <label class="order_number_monitoring"></label></b></h5> 
			        <button type="button" class="close" id="dismiss_monitoring_detail" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			       <div class="modal-body">
					    <div class="container">
							
			
									
							<input type="hidden" value="" id="attri_order_id" name="">
							<input type="hidden" value="" id="attri_customer_id" name="">

							<div class="row">
								<div class="col-md-6">
									<div class="card">
									  <div class="card-header" style="background: linear-gradient(25deg, #00e4d0, #5983e8); color:white;">
									     <i class="fas fa-address-card"></i> Default Shipping Address
									  </div>
									  <div class="card-body">
									    <label class="monitor_customer_name"></label>
									    <div style="font-size:14px; line-height: 9px;">
									    	<label class="monitor_customer_address"></label><br>
									    	<label class="monitor_customer_number"></label>
									    </div>
									   {{--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
									    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
									  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
									    <i class="fas fa-users" style="color:white;"></i> Personal Profile
									  </div>
									  <div class="card-body" style="font-size:14px; line-height: 9px;">
									    <label class="monitor_customer_name"></label><br>
									    <label class="monitor_customer_email"></label><br><br><br><br>


									    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
									    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
									  </div>
									</div>
								</div>
							</div>
									
							<br><br>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
									  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
									    <i class="fas fa-cart-arrow-down"></i> Customer Orders
									  </div>
									    <div class="table-responsive">
									    	   <table class="table table-hover">
												  <thead style="background: linear-gradient(25deg, #00e4d0, #5983e8); color:white; font-size:14px;">
												    <tr>
												      <th scope="col">Menu Image</th>
												      <th scope="col">Menu Name</th>
												      <th scope="col">Quantity</th>
												      <th scope="col">Subtotal</th>
												    </tr>
												  </thead>

													  <tbody style="font-size:15px;" id="result">
												
													  </tbody>

												</table>
									    </div>
									</div>
								</div>
							</div>


							
								<div class="jumbotron" style="">
									<div class="row">
					     				<div class="col-md-3">
					     					
					     					<div class="cart-detail" style="font-size:14px;">
					     						<label><b>Subtotal:</b></label><br>
							     				<label><b>Tax GST 5%:</b></label><br>
							     				<label><b>Delivery Charge $5</b></label>
							     				<hr>
							     				<label style="font-size: 20px;"><b>Total:</b></label>
					     					</div>
					     				</div>
					     			
					     				<br>
					     				<div class="col-md-6"></div>
					     				<div class="col-md-3">
					     					<div class="cart-detail" style="font-size:14px; position: relative; left:20px;">
					     						<label id="sub_total"></label><br>
					     						
					     						<label id="label_province_tax_rate"></label> <br>

					     						
					     						<label id="label_delivery_charge"></label>

					     						<br><br>
					     						<b><label id="total_price_label" style="font-size:20px;"></label></b>
					     					</div>
					     				</div>
					     				
					     			</div>
								</div>
							



						</div>
		     	   </div>
			    </div>
		    </div>
		</div>
	</div>
</form>




<!--add product -->
<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="driver_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="container-fluid">
			<div class="modal-dialog modal-lg" role="document" style="width:50%;">
				<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Driver Assign</h5> 
			        <button type="button" class="close" id="dismiss_driver_assign" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			       <div class="modal-body">
					    <div class="container">
							
						

							<center>

		                        <div class="find_driver">

									<input type="hidden" value="" id="assign_customer_order_id" name="">
									

		                        	<h2>Find Driver to Customer <h2 id="assign_customer"></h2> </h2>
		                            <img src="{{asset('/Images/Ripple.gif')}}" class="img-fluid" alt="" id="">
		                            {{-- <div class="container"><h3>Wait for <span id="countdowntimer">5</span> seconds to gather data of driver.</h3></div> --}}
		                            <h4>Wait for <span id="count">5</span> seconds to gather data of driver.</h4>
		                        </div>
		                        <div class="driver_info">
		                            <input type="hidden" name="" id="driver_details" value="">
		                            <br>
		                            <h1>You found a driver!</h1>
		                            <h5>Store of 1790</h5>
		                            <div style="color:yellow;">
		                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
		                            </div>
		                            <img src="{{asset('/Images/kfc-rider.png')}}" style="width:55%;" class="img-fluid" alt="" id="">

		                            <div class="table-responsive">
					                    <table id="driversLineupTable" class="table table-hover" style="font-size:14px;">
					                            <thead style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; font-size:13px;">
					                                <tr> 
					                                <th scope="col">Status</th>
					                                <th scope="col">Driver</th>
					                                <th scope="col" style="width:15%;">Email</th>
					                                <th scope="col">Contact Number</th>
					                                <th>Action</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					            					
					            					@foreach($driver_details as $details)
					            						<tr>
					            							<td>{{$details->driver_status}}</td>
					            							<td>{{$details->driver_name}}</td>
					            							<td>{{$details->driver_email}}</td>
					            							<td>{{$details->driver_number}}</td>
					            							<td><button value="{{$details->driver_id}}" class="btn btn-primary form-control" id="assign_customer_button" type="button">Assign to customer</button></td>
					            						</tr>
					            					@endforeach

					                                
					                            </tbody>
					                    </table>
					                </div>
		                            {{-- <button type="button" class="btn btn-primary" id="registerDriverButton" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); border-color:transparent; height:50px;">Add to line up</button> --}}
		                        </div>
		                    </center>


						</div>
		     	   </div>
			    </div>
		    </div>
		</div>
	</div>
</form>



<br><br><br><br>
@endsection