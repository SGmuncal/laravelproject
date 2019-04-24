@extends('layouts.adminnavbar')
<style>
	.centered {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  color:white;
	  font-size:50px;
	}
</style>
@section('admin_content')
<div class="container">

	<div class="col-md-12 float-left">
		<h4>Deliver to: <?php
		

		if(isset($_GET['deliverto'])){
		  $delivery_address = $_GET['deliverto'];
		  $session_address = Session::put('address',$delivery_address);
		  echo Session::get('address');
		  
		} else {
		  echo "failed";
		}
				

		?></h4>
		<br>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">For Sharing</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">For One</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Deal</a>
		  </li>
		</ul>

		
	</div>

	<br><br>

	<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		  	<br><br><br><br>
	  		<div class="col-md-4">
	  			<div class="card">
			  		@foreach($menu_sharing_image as $image)@endforeach
			  		<img class="card-img-top img-fluid" style="background-attachment: fixed;" src="/storage/{{$image->menu_sec_image}}" alt="Card image cap">
			  		<div class="centered">For Sharing</div>
				</div>
	  		</div>
		  	
			<br><br>
			<div class="row">
				@foreach($menu_data_sharing as $data_sharing)
					
						<div class="col-md-4">
							<div class="card">
							  <img class="card-img-top" src="/storage/{{$data_sharing->menu_main_image}}" alt="Card image cap">
							  <div class="card-body">
							    <h5 class="card-title">{{$data_sharing->menu_name}}</h5>
							    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							    <a href="/customize_menu_category" class="btn btn-primary">Go to category section</a>
							  </div>
							</div>
							<br><br>
						</div>

				@endforeach
			</div>
		  </div>
		  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
		  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
	</div>
</div>

<br><br><br><br><br><br><br><br><br><br><br>
@endsection