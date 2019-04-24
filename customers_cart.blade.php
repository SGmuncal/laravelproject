@extends('layouts.adminnavbar')

@section('admin_content')

<br><br>
	<div class="jumbotron" style="background-color:#3204ad;">
		
			
		<center>
			<i class="fas fa-shipping-fast" style="font-size:100px; color:white;"></i><br><br>
			<h1 style="color:white;">Our passion is your success.</h1>
			<h4 style="color:white; font-weight: 300;">Reach More Customers</h4>
		</center>
		
	</div>
	
		<div class="jumbotron" style="background-color:white;">
		<h3>Store @if(Auth::user()){{Auth::user()->store_name}}@endif Customer List</h3>
		<br>
	    <div class="table-responsive" style="">
		    
		    <table id="tables_customer_details" class="table table-striped table-bordered" style="width:100%;">
		        <thead>
		            <tr style="background-color:none !important; border-style:hidden !important; font-size: 14px; ">
		            	<th></th>
		                <th scope="col">Customer Name</th>
		                <th scope="col">Customer Number</th>
		                <th scope="col">Customer Address</th>
		                <th scope="col">Customer Location</th>
		                <th scope="col">Customer Email</th>
		                <th scope="col">Action</th>
		            </tr>
		        </thead>
		        <tbody style=" font-size:14px;">
		        	
		        	
	        		@if(Auth::user())
	        			@foreach($customer_details as $detail)
			        		<tr>
			        			<td><i class="fas fa-users"></i></td>
				                <td>{{$detail->customer_name}}</td>
				                <td>{{$detail->customer_number}}</td>
				                <td>{{$detail->customer_address}}</td>
				                <td>{{$detail->customer_location}}</td>
				                <td>{{$detail->customer_email}}</td>

				              
				                 <td><a class="btn btn-primary cart_open" href="/customers_wish_list/{{$detail->customer_id}}" value="{{$detail->customer_id}}" id="show_cart" style="color:white;"><i class="fas fa-eye"></i></a></td>


				            </tr>
			        	@endforeach
	        		@endif
			        	

		        </tbody>
		    </table>
	    </div>
	
</div>



<br><br><br><br>
@endsection