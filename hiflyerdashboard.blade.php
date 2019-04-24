

@extends('layouts.adminnavbar')

@section('admin_content')


		<h3>Dashboard</h3>
		<p>Welcome to Hiflyer CMS Dashboard</p>
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
				  <div class="card-header" style="background-color:#3204ad">
				    <i class="fas fa-users" style="color:white;"></i>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Total Registered Users: {{$user}}</h5>
				    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
				    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
				  </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
				  <div class="card-header" style="background-color:#3204ad">
				     <i class="fas fa-credit-card" style="color:white;"></i>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Total Transactions: (Soon)</h5>
				   {{--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
				    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
				  </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
				  <div class="card-header" style="background-color:#3204ad">
				    <i class="fas fa-inbox" style="color:white ;"></i>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Total Messages:
				    	@foreach($countmessage as $get_total_message)
              			@endforeach
              			{{$get_total_message->total_message}}
				    </h5>
				   {{--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
				    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
				  </div>
				</div>
			</div>
		</div>
	

	<br>



	<div class="jumbotron" style="background-color:white;">
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
				<table class="table table-hover">
				  <thead>
				  	{{-- <a href="{{ url('mails') }}" style="text-decoration: none;"><text class="" style="color:black;"><i class="fas fa-inbox" style="color:#007BFF;"></i> View More</text></a> --}}
				  	<h3>Latest Mail</h3>
				  	<br>
				    <tr style="font-size:14px;">
				      <th scope="col">Name</th>
				      <th scope="col">Subject</th>
				      <th scope="col">Email</th>
				      <th scope="col">Contact Number</th>
				      <th scope="col">Store Number</th>
				      <th scope="col">Transaction Number</th>
				      <th scope="col">Date of transaction</th>
				      <th scope="col">Status</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($unread as $get_unread)
	                    <tr style="font-size:14px;">
	                      <td>{{$get_unread->firstname}} {{$get_unread->lastname}}</a></td>
	                      <td>{{$get_unread->subject}}</td>
	                      <td>{{$get_unread->email}}</td>
	                      <td>{{$get_unread->contact}}</td>
	                      <td>{{$get_unread->store_number}}</td>
	                      <td>{{$get_unread->transaction_number}}</td>
	                      <td>{{$get_unread->transaction_date}}</td>
	                      <td>{{$get_unread->status}}</td>
	                      <td>
	                      	<a href="{{ url('mailfrom',$get_unread->id) }}" id="main_email_button" class="btn btn-primary form-control"><i class="fab fa-readme"></i></a>
	                      </td>
	                    </tr>
                  	@endforeach
				  </tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	</div>

<br><br><br><br>
@endsection