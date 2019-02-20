@extends('layouts.navbar')

@section('content')
<div class="jumbotron"  style="background-image: url('./Images/careers-bg.jpg'); height:500px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;">
    <div class="container">
    	<div class="content-search-career" style="color:white; text-align: center;">
    		<div class="col-md-12">
    			<br><br> <br>    <br> 	
		    	<h2>Alone we can do so little,together we can do so much!</h2>
		    	<br>

		      	<div class="input-group">
				  <select name="position_name" class="custom-select" id="append_option_list_position">
                    <option value="" selected="" disabled="disabled">Select a Job Position</option>
                    <option value="alljob">All Jobs</option>
                  </select>
				  <div class="input-group-append">
				    <button class="btn btn-outline-primary" type="submit" id="serach_position_btn">Search</button>
				  </div>
				</div>

    		</div>
    	</div>
    </div>
</div>


<div class="container">

	<div class="row">

		<div class="col-md-6">
			<a  style="color:black; font-weight: 500; font-size:25px;">Hot vacancies</a>
		</div>
		<br><br>
		<div class="col-md-6"></div>
					
	</div>
</div>

<br><br>
<div class="container">
	<div class="row" id="position_list">
		
	</div>

	<div class="row" id="search_position_list">
		
	</div>
</div>

@endsection