@extends('layouts.navbar')

@section('content')
<?php $city = $_GET['city'];?>
<center>
	<div class="jumbotron"  style="background-image: url('./Images/order-bg.png'); height:660px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat; background-color:white;">
    <div class="container">
    	<div class="content-search-career" style="color:black; text-align: center;">
    		
    			<br><br><br><br><br><br><br><br> 	
		    	<h1 style="font-weight: bold;">It's the food you love, delivered</h1>
		    	<br>

		    	<form action="/search_city_delivery" method="get">

		    	{{csrf_field()}}


			      	<div class="input-group">
					  <select name="city" style="height:60px;" required="" class="custom-select" id="inputGroupSelect04">
	                    <option value="<?php echo $city ?>" selected="" disabled="disabled"><?php echo $city ?></option>
	                  {{--   <option value="Winnipeg">Winnipeg</option>
	                    <option value="Edmonton">Edmonton</option>
	                    <option value="Calgarey">Calgarey</option> --}}
	                  </select>
					  <div class="input-group-append">
					    <button class="btn btn-primary" type="submit">Find Store</button>
					  </div>
					</div>

			    </form>
			    {{-- <p class="lead">Your message here</p>
			    <p><a href="http://www.YourLinkHere.com" class="btn btn-primary btn-lg">Learn more &raquo;</a></p> --}}
    		
    	</div>
    </div>
</div>

</center>

<div class="jumbotron" style="background-color:white;">
	<div class="container">
		<h1 align="center">List Store in <?php echo $city ?></h1>
		<br>
		<div class="row">
			@foreach($city_info as $info)

				<div class="col-md-3">
					<a href="/store_address/{{$info->id}}" style="text-decoration: none;">
						<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=1" alt="slide 3">

						 <br>
						 <div id="store-delivery-details" style="line-height: 15px; font-size:14px; text-decoration: none; color:black;">
						 	 <p><b>{{$info->store_address}}</b></p>
							 <p>{{$info->store_contactnumber}}</p>
							 <p>{{$info->store_businesshour}}</p>
							 <p>{{$info->store_type}}</p>

						 </div>
						 <br>
					</a> 
				</div>

			
			@endforeach
		</div>
	</div>
</div>





@endsection