@extends('layouts.adminnavbar')

@section('admin_content')
	<div class="jumbotron" style="background-color:white;">

		<div class="container">
			<center>
				<h1>Choose Your Menu Setting</h1>
				<p>How do you want to fill the content information?</p>
				<br><br>
							
				<div class="row">
					<div class="col-md-6">
						<div class="card">
						  <div class="card-body" style="background-color:#6D7FCC; border-color:#6D7FCC; color:white;">
						  	<i class="fab fa-creative-commons-share" style="font-size:60px;"></i>
						  	<br>
						    I have new update for the content.
						    <br><br>
						    <a href="{{ url('menu_insert_manager') }}" class="btn btn-outline-primary" style="border-color:white; color:white;">Create Food Menu</a>
						  </div>
						</div>
					</div>



				<br><br>

					<div class="col-md-6">
						<div class="card">
						  <div class="card-body">
						  	<i class="far fa-edit" style="font-size:60px;"></i>
						  	<br>
						    I have new update for the content.
						    <br><br>
						    <a href="{{ url('menu_category_insert_manager') }}" class="btn btn-primary">Create Food Menu Category</a>
						  </div>
						</div>
					</div>
				</div>

			
				{{-- <div class="row">
					<div class="col-md-12">
						<div class="card">
						  <div class="card-body" style="background-color:#16a085; border-color:#16a085; color:white;">
						  	<i class="icon ion-md-settings" style="font-size:50px;"></i>
						  	<br>
						    I have new content i want to use.						     
						    <br><br>
						    <a href="{{ url('menu_section') }}" class="btn btn-outline-primary" style="border-color:white; color:white;">Food Condiments</a>
						  </div>
						</div>
						<br><br>
					</div>
				</div>
				 --}}
			</center>
		</div>

	</div>
<br><br><br><br>
@endsection

