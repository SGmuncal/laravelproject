@extends('layouts.adminnavbar')

@section('admin_content')

<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 300px;
    width:100%;
  }
  /* Optional: Makes the sample page fill the window. */
  .controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  .pac-container { z-index: 100000; }

  #origin-input,
  #destination-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 200px;
  }

  #origin-input:focus,
  #destination-input:focus {
    border-color: #4d90fe;
  }

  #mode-selector {
    color: #fff;
    background-color: #4d90fe;
    margin-left: 12px;
    padding: 5px 11px 0px 11px;
  }

  #mode-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

</style>


<div class="container">
	<div class="row">
		<h2 class="day-message"></h2><h2>, Store @if(Auth::user()){{Auth::user()->store_name}}@endif</h2>
	</div> 
{{-- 	<span class="date"></span> --}}
</div>
<br>
@if(Auth::user())
<input type="hidden" name="" id="auth_postal_code" value="{{Auth::user()->store_postal_code}}">
@endif
<div class="row">
	<div class="col-md-4">
		<div class="card">
		  <div class="card-header">
		    <i class="fas fa-users"></i> Customers
		  </div>
		  <div class="card-body" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
		    <i class="far fa-user" style="font-size:40px; color:white !important;"> </i> <label style="font-weight: 300; font-size:40px; color:white">{{ $total_users }}</label>
				 <br>
				 <label style="font-weight: bold; color:white">Total Customers</label>
		  </div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
		  <div class="card-header" >
		     <i class="fas fa-address-card"></i> Ordered
		  </div>
		  <div class="card-body" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			   	<i class="fas fa-cart-plus" style="font-size:40px; color:white !important;"></i>  <label style="font-weight: 300; font-size:40px; color:white">{{ $total_users_already_delivered }}</label>
					 <br>
					 <label style="font-weight: bold; color:white">Total Customers Ordered</label>
			  </div>
			</div>
		</div>
	<div class="col-md-4">
		<div class="card">
		  <div class="card-header" >
		    <i class="fas fa-truck"></i> Canceled Order
		  </div>
		  <div class="card-body" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
		     <i class="fas fa-bell-slash" style="font-size:40px; color:white !important;"></i>   <label style="font-weight: 300; font-size:40px; color:white">{{ $total_users_cancelled_deliver }}</label>
				 <br>
				 <label style="font-weight: bold; color:white">Total Customers Canceled Order</label>
		  </div>
		</div>
	</div>
</div>
<!-- <div class="jumbotron" style="background-color:#3366CC;">
	
	<center>
		<div class="row">
			<div class="col-md-4">
				 
			</div>
			<div class="col-md-4">
				 
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</center>
</div> -->




<div class="jumbotron" style="background-color:white;">
	<div class="container">
	    <div class="table-responsive" style="">
		    <button class="btn btn-danger" data-toggle="modal" data-target="#add_customer">Register Customer <i class="fas fa-user"></i></button>
				<br><br>
				<table id="tables" class="table table-striped table-bordered" style="width:100%;">
		        <thead>
		            <tr style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; font-size:14px; text-align: center;">
		                <th scope="col">Name</th>
		                <th scope="col">Ship to</th>
		                <th scope="col">Email</th>
		                <th scope="col">Telephone</th>
		                <th scope="col">Store Location</th>
		                <th scope="col">Customer Other Details</th>
		                <th scope="col">Date Called</th>
		                <th scope="col">Action</th>
		            </tr>
		        </thead>
					<tbody style=" font-size:14px;">
						
						

		        	</tbody>
		    </table>
	    </div>
	</div>
</div>







<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Customer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeRegistration">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		        <div class="modal-body">
		    		<div class="alert alert-dark" role="alert" style="background-color:#3366CC; color:white;">
					  If the user exist, via searching you can easily access there information, and start order
					</div>
					<div class="container">
						<input id="origin-input" class="controls" type="text"
				        placeholder="Store Postal Code">

				    <input id="destination-input" class="controls" type="text"
				        placeholder="Customer Postal Code">

				    <div id="mode-selector" class="controls">
				      <input type="radio" name="type" id="changemode-walking" checked="checked">
				      <label for="changemode-walking">Walking</label>

				      <input type="radio" name="type" id="changemode-transit">
				      <label for="changemode-transit">Transit</label>

				      <input type="radio" name="type" id="changemode-driving">
				      <label for="changemode-driving">Driving</label>
				    </div>

				    <div id="map"></div>
					</div>
					<br><br>
					
		    		<div class="row">
						<div class="col-md-6">
							<label>Customer Name: </label>
							<input placeholder="Joel" name="customer_name" value="" required="" class="form-control" id="customer_name" type="text" class="validate">
						</div>
						<div class="col-md-6">
							<label>Customer #: </label>
							<input placeholder="Customer Phone #" maxlength="11"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="customer_number" required="" value="" class="form-control" id="customer_number" type="number" class="validate">
					    </div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-6">
							<label>Email Address: </label>
							<input placeholder="Email" name="customer_email" value="" required="" class="form-control" id="customer_email" type="email" class="validate">
						</div>
						<div class="col-md-6">
							<label>Postal Code: </label>
							<input type="text" maxlength="6"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="customer_postal" id="customer_postal" required="" class="form-control"  placeholder="">
					    </div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label>Register to store: </label>
							@if(Auth::user())
							<input placeholder="{{Auth::user()->store_name}}" readonly="" name="customer_location" value="{{Auth::user()->store_name}}" class="form-control" id="customer_location" type="text" class="validate">
							@endif
						</div>
					</div>
					<br><br>
					<div class="col-md-12">
						<label>Customer Order Note:</label>
						<textarea name="customer_order" required="required" id="customer_order" class="form-control"></textarea>
						<script>
							CKEDITOR.replace( 'customer_order' );
						</script>
					</div>
		    	
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="save_customer_details" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); border-color:transparent;">Save changes</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>



<div class="modal fade" id="add_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg float-left" role="document">
    <div class="modal-content" style="width:1360px;">
      <div class="modal-header"  style="background: linear-gradient(-20deg, #00e4d0, #5983e8);">
        <h4 class="modal-title" id="exampleModalLongTitle" style="color:white;">Shopping Cart <i class="fas fa-cart-arrow-down"></i></h4>	
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="refresh_order">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


 	    <div class="modal-body" style="width:1360px;">

	     	<div class="row">
	     		 <div class="col-md-8">
	     		 	<div class="jumbotron">

	     		 		<div class="table-responsive conditional_table_hidden_noun">
						   	 <table id="tables_orders" class="table table-striped table-bordered" style="width:100%">
						        <thead>
						            <tr style="background: linear-gradient(-20deg, #00e4d0, #5983e8); color:white;" >
						                <th>Menu</th>
						                <th>Menu Desc</th>
						                <th>Menu Price</th>
						                <th>Menu Image</th>
						                <th style="display:none;"></th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($category as $menu)
						        		<tr id="productClicked" style="font-size:16px;">
						        			<td class="menu_name">{{$menu->menu_cat_name}}</td>
						        			<td>
						        			{!!
						                        str_limit($menu->menu_cat_desc, $limit = 25, $end = '...')
						                    !!}
						                    </td>
						        			<td class="menu_price">{{$menu->menu_cat_price}}</td>
						        			<td>
						        				<center>
						        					<img src="{{url('/storage/'.$menu->menu_cat_image.'')}}" class="img-fluid" style="width:170px;">
						        				</center>
						        			</td>
						        			<td class="chain_id" style="display:none;">{{$menu->chain_id}}</td>
						        		</tr>
						        	@endforeach
						        </tbody>
						    </table>
					   </div>

					   <div class="conditional_table_hidden_condiments">
						   	<div class="container">

	<!-- 							<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<div class="input-group">
										  <span class="input-group-prepend">
										    <div class="input-group-text bg-transparent border-right-0">
										      <i class="fa fa-search" style="color:#007BFF;"></i>
										    </div>
										  </span>
										  <input class="form-control py-2 border-left-0 border" type="search" value="Search Condiments" id="search_attach_append_condiments" />
										  <span class="input-group-append">

										  </span>
										</div>
									</div>
								</div>
								<br> -->

								<table  class="table table-striped table-bordered " id="customer_table_update_chain_order" style="width:100%">
									<div class="content-noun" style="text-align: center;">
									<thead>
							            <tr style="background: linear-gradient(-20deg, #00e4d0, #5983e8); color:white;" >
							             	<th>Condiment Screen Name</th>
								             <th>Condiment Price</th>
								             <th>Condiment Image</th>
							            </tr>
						            </thead>
						            	</div>
						            <tbody>
							         	
						            </tbody>
								</table>
			    	  
				    		</div>
				    		<center>
				    			<button class="back_to_noun btn btn-primary">Back to Noun</button>
				    		</center>
					   </div>

	     		 	</div>
                   	
	     		 </div>
	     	 	<div class="col-md-4">
	     	 		<div class="container">
	     	 			<div class="jumbotron" style="background: linear-gradient(-20deg, #00e4d0, #5983e8);">
	     	 				<div class="header" style="text-align: center;">
	     	 					<i class="fas fa-cart-arrow-down" style="font-size:50px; color:white;"></i>
	     	 					<br><br>
	     	 					
				    			<h3 style="font-weight: bold; color:white;">Build customer meal.</h3>
				    			<label style="color:white;  font-size:15px;">This button will be served as customers menu.</label><br>
				    			<div style="line-height:15px;">

							    	<b style="font-size:17px; font-weight: 300; color:white;"><label>Customer: </label> <label id="append_customer_name" style="font-weight: 300;"> </label></b>
							    	<label style="font-size:17px; font-weight: 300; color:white;">Deliver to: <label id="place_customer" style="font-weight: 300;"></label> </label>

					     	 	</div>	
				    			

					     	 	<br>
								<h4 style="color:white; font-weight:bold;" class="append_customer_noun_order"></h4>
								<h5 style="color:white;" class="append_customer_price_order"></h5>
								<br>
				    			<input type="hidden" value="" class="hidden_noun_id" name="">
					    			<table class="table table-hover upsize_check" id="noun_chaining_order" style="border:none;">
					    				<thead>
								            <tr style="font-size: 15px;  color:white;">
								                <th scope="col">Qty</th>
								                <th scope="col">Condiments</th>
								                <th scope="col">Price</th>
								            </tr>
								        </thead>
								        <tbody style="font-size:14px; color:white;" class="tbody_noun_chaining_order">	        		
							        		
								        </tbody>
					    			</table>
					    			<!-- <button type="button" style="" class="form-control btn-primary"></button> -->
					    			<hr>
					    			<div class="row">
					    				<input type="hidden" name="" value="" id="hidden_customer_id">
					    				<input type="hidden" value="" id="customer_details">
					    				<div class="col-md-7"  style="color:white; font-size: 30px; font-weight: bold;">Total:</div>
					    				<div class="col-md-3" style="color:white; font-weight: bold; font-size: 30px;"><p class="append_customer_noun_order_price">0.00</p></div>
					    			</div>
					    			<hr>
				    			 <br>
				    			 <button type="button" class="btn btn-primary" style="background-color:#3D0081; border-color:#3D0081;" id="add_to_cart">Add To Customer Cart</button>
				    		</div>
	     	 			</div>
	     	 		</div>
	     	 	</div>
	     	</div>
     	</div>
    </div>
  </div>
</div>



   					
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWCz4V5r29GxcGZKNtFzE9v4gOSnKVMYA&libraries=places&callback=initMap"
        async defer></script>
    <script>

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: 49.8951, lng: -97.1384},
          zoom: 13
        });

        new AutocompleteDirectionsHandler(map);
      }

       /**
        * @constructor
       */
      function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'WALKING';
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: true});

        this.setupClickListener('changemode-walking', 'WALKING');
        this.setupClickListener('changemode-transit', 'TRANSIT');
        this.setupClickListener('changemode-driving', 'DRIVING');

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
      }

      // Sets a listener on a radio button to change the filter type on Places
      // Autocomplete.
      AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
        var radioButton = document.getElementById(id);
        var me = this;
        radioButton.addEventListener('click', function() {
          me.travelMode = mode;
          me.route();
        });
      };

      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.setComponentRestrictions(
            {'country': ['ca']});
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            window.alert("Please select an option from the dropdown list.");
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          me.route();
        });

      };

      AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
          return;
        }
        var me = this;

        this.directionsService.route({
          origin: {'placeId': this.originPlaceId},
          destination: {'placeId': this.destinationPlaceId},
          travelMode: this.travelMode
        }, function(response, status) {
          if (status === 'OK') {
            me.directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      };

    </script>

<br><br><br><br>
@endsection