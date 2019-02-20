@extends('layouts.adminnavbar')

@section('admin_content')
	<div class="jumbotron" style="background-color:white;">

		<div class="container">
			<center>
				<h1>Create New Content For Slider</h1>
				<p>How do you want to fill the content information?</p>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
						  <div class="card-body" style="background-color:#6D7FCC; border-color:#6D7FCC; color:white;">
						  	<i class="fab fa-creative-commons-share" style="font-size:60px;"></i>
						  	<br>
						    I have new content i want to use.						     
						    <br><br>
						    <a href="{{ url('slider_insert_manager') }}" class="btn btn-outline-primary" style="border-color:white; color:white;">Press to Insert Data</a>
						  </div>
						</div>
						<br><br>
					</div>

					<div class="col-md-6">
						<div class="card">
						  <div class="card-body">
						  	<i class="far fa-edit" style="font-size:60px;"></i>
						  	<br>
						    I have new update for the content.
						    <br><br>
						    <a href="{{ url('slider_update_manager') }}" class="btn btn-primary">Press to Update Data</a>
						  </div>
						</div>
					</div>
				</div>
			</center>
		</div>

	</div>
<br><br><br><br>
@endsection

