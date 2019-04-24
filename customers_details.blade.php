@extends('layouts.adminnavbar')

@section('admin_content')


<h3>Store @if(Auth::user()){{Auth::user()->store_name}}@endif Customer List</h3>
<br>

	
		<div class="jumbotron" style="background-color:white;">
	    <div class="table-responsive" style="">
		    
		    <table id="tables_customer_details" class="table table-striped table-bordered" style="width:100%;">
		        <thead>
		            <tr style="background-color:none !important; border-style:hidden !important; font-size: 14px; ">
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
				                <td>{{$detail->customer_name}}</td>
				                <td>{{$detail->customer_number}}</td>
				                <td>{{$detail->customer_address}}</td>
				                <td>{{$detail->customer_location}}</td>
				                <td>{{$detail->customer_email}}</td>

				              
				                 <td><center><a class="btn btn-primary" href="/customer_profile/{{$detail->customer_id}}" value="{{$detail->customer_id}}" id="show_cart" style="color:white;"><i class="fas fa-eye"></i></a></center></td>


				            </tr>
			        	@endforeach
	        		@endif
			        	

		        </tbody>
		    </table>
	    
	</div>
</div>



<br><br><br><br>
@endsection