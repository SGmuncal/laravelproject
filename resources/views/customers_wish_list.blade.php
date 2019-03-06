@extends('layouts.adminnavbar')

@section('admin_content')

<div class="container">
	<h3>Customer Order</h3>
	<br>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
			  <div class="card-header" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
			    <i class="fas fa-users"></i> Personal Profile
			  </div>
			  <div class="card-body">
			    <label></label><br>
			    <label></label>
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
			    <div style="font-size:14px; line-height: 9px;">
			    	<label></label><br>
			    	<label></label>
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
			    <h3>$5.00</h3>
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
				<h2><i class="fab fa-opencart"></i> Orders</h2>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-11">
				<p style="font-weight: bold;">1x 12 PIECE Bucket with Fries <br></p>
				&nbsp;&nbsp;&nbsp;<label>1x Large Fries</label><br>
				&nbsp;&nbsp;&nbsp;<label>3x Medium Homestyle Coleslaw</label>
				
			</div>
			<div class="col-md-1">
				<i class="far fa-trash-alt"></i><br><br>
				<label style="font-weight: bold;">$29.00</label>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-11">
				<p style="font-weight: bold;">1x 10 PIECE Feast<br></p>
				&nbsp;&nbsp;&nbsp;<label>1x Large Fries</label><br>
				&nbsp;&nbsp;&nbsp;<label>3x Medium Homestyle Coleslaw</label>
				
			</div>
			<div class="col-md-1">
				<i class="far fa-trash-alt"></i><br><br>
				<label style="font-weight: bold;">$29.00</label>
			</div>
		</div>
		<hr>
		
			<div class="d-flex">
				
				<div>
					<p style="font-weight: bold;">Items<br></p>
					<p style="font-weight: bold;">Subtotal:<br></p>
					<br>
					<label>Tax:</label><br>
					<label>Delivery Charge:</label><br>
					<label>Total:</label><br>

				</div>

				<div class="ml-auto">
					<p style="font-weight: bold;">2<br></p>
					<p style="font-weight: bold;">$100<br></p>
					<br>
					<label>Tax: $5.00</label><br>
					<label>Delivery Charge: $5.00</label><br>
					<label>Total: $120.00</label><br>
				</div>
			</div>

			
		
		<br><br><br>
		<center>
			<div class="col-md-6">
				<button class="btn btn-primary form-control">Proceed to checkout</button><br><br>
				<button class="btn btn-outline-danger form-control">Add More Food</button><br>
			</div>
		</center>
	</div>
</div>

<br><br><br><br>
@endsection