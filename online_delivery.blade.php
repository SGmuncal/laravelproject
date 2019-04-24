@extends('layouts.navbar')


@section('content')
<center>
	<div class="jumbotron"  style="background-image: url('./Images/order-bg.png'); height:660px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat; background-color:white;">
    <div class="container">
    	<div class="content-search-career" style="color:black; text-align: center;">
    		
    			<br><br><br><br><br><br><br><br> 	
		    	<h1 style="font-weight: bold;">It's the food you love, delivered</h1>
		    	<br>

		    	<form {{-- action="/search_city_delivery" --}} method="get">

		    	{{csrf_field()}}

		    		<div class="pac-card" id="pac-card">
			      <div>
			        <div id="title">
			         {{--  Countries --}}
			        </div>
			        {{-- <div id="country-selector" class="pac-controls">
			          <input type="radio" name="type" id="changecountry-usa">
			          <label for="changecountry-usa">USA</label>

			          <input type="radio" name="type" id="changecountry-usa-and-uot" checked="checked">
			          <label for="changecountry-usa-and-uot">USA and unincorporated organized territories</label>
			        </div> --}}
			      </div>
			      <div id="pac-container">
			      	<div class="input-group mb-3">
					  <input id="pac-input" type="text"
			            placeholder="Enter your address or postal code to get start" class="form-control">
					  <div class="input-group-append">
					    <button class="btn btn-primary" type="button">Go</button>
					  </div>
					</div>
			        
			      </div>
			    </div>
			    <div id="map" style="display:hidden;"></div>
			    <div id="infowindow-content">
			      <img src="" width="16" height="16" id="place-icon">
			      <span id="place-name"  class="title"></span><br>
			      <span id="place-address"></span>
			    </div>

			      	{{-- <div class="input-group">
					  <select name="city" style="height:60px;" class="custom-select" id="inputGroupSelect04">
	                    <option value="" selected="" disabled="disabled">Select City</option>
	                    <option value="Winnipeg">Winnipeg</option>
	                    <option value="Edmonton">Edmonton</option>
	                    <option value="Calgarey">Calgarey</option>
	                  </select>
					  <div class="input-group-append">
					    <button class="btn btn-primary" type="submit">Find Store</button>
					  </div>
					</div> --}}

			    </form>
			    {{-- <p class="lead">Your message here</p>
			    <p><a href="http://www.YourLinkHere.com" class="btn btn-primary btn-lg">Learn more &raquo;</a></p> --}}
    		
    	</div>
    </div>
</div>

 



    

<div class="jumbotron" style="background-color:white;">
	<h4 style="color:#3366FF; font-weight: bold;">Get in touch!</h4>
	<h3>LET US MAKE FOOD ORDERING EASIER FOR YOU!</h3>
	<br>
	<p>Interested? Please get in touch at any time. We look forward to hearing from you and to answering your questions.</p>

	<button class="btn btn-primary">CONTACT US</button>
</div>

</center>

	<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 50.064192, lng: -130.605469},
          zoom: 3
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var countries = document.getElementById('country-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['ca']});

        // Specify only the data fields that are needed.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a given radio button. The radio buttons specify
        // the countries used to restrict the autocomplete search.
        function setupClickListener(id, countries) {
          // var radioButton = document.getElementById(id);
          // radioButton.addEventListener('click', function() {
            
          // });
          autocomplete.setComponentRestrictions({'country': countries});
        }

        setupClickListener('changecountry-usa', 'ca');
        setupClickListener(
            'changecountry-usa-and-uot', ['ca']);
      }
    </script>

     

@endsection