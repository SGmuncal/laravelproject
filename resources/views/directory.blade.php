@extends('layouts.navbar')

@section('content')
 <center>
        <br><br><br><br>     
        <div class="jumbotron" style="background-color:white;">
            <div class="container">
                <div class="col-md-4">
                    <i class="fas fa-map-marker-alt" style="font-size:55px; color:#143DF6;"></i>
                </div>
            </div>
            <h1 style="color:black; font-weight: bold;">Find your nearest store.</h1>
            <h4>by searching here.</h4>
            <br><br>
            <ul class="list-inline">

                <?php 
                
                


                    if(isset($_GET['inpaddress']))
                    {
                        $val = $_GET['inpaddress'];



                        if($val == 'Winnipeg')
                        {
                            echo '

                                <li class="" ><a href="Winnipeg" class="city" style="font-weight:bold; font-weight:bold; color:#143DF6; border-bottom:1px solid #143DF6; text-decoration:none;">WINNIPEG </a></li> -
                                <li class=""><a href="Edmonton" class="city" style="font-weight:bold; color:black; text-decoration:none;">EDMONTON </a></li> -
                                <li class=""><a href="Calgary" class="city" style="font-weight:bold; color:black; text-decoration:none;">CALGARY</a></li>

                            ';
                        }
                        else if($val == 'Edmonton')
                        {
                            echo '

                                <li class="" ><a href="Winnipeg" class="city" style="font-weight:bold; color:black; text-decoration:none;">WINNIPEG </a></li> -
                                <li class=""><a href="Edmonton" class="city" style="font-weight:bold; color:#143DF6; border-bottom:1px solid #143DF6; text-decoration:none;">EDMONTON </a></li> -
                                <li class=""><a href="Calgary" class="city" style="font-weight:bold; color:black; text-decoration:none;">CALGARY</a></li>

                            ';
                        }
                        else if($val == 'Calgary')
                        {
                            echo '

                                <li class="" ><a href="Winnipeg" class="city" style="font-weight:bold; color:black; text-decoration:none;">WINNIPEG </a></li> -
                                <li class=""><a href="Edmonton" class="city" style="font-weight:bold; color:black; text-decoration:none;  ">EDMONTON </a></li> -
                                <li class=""><a href="Calgary" class="city" style="font-weight:bold; color:#143DF6; border-bottom:1px solid #143DF6; text-decoration:none;">CALGARY</a></li>


                            ';
                        }
                        else
                        {
                            echo '

                                <li class="" ><a href="Winnipeg" class="city" style="font-weight:bold; color:black;">WINNIPEG </a></li> -
                                <li class=""><a href="Edmonton" class="city" style="font-weight:bold; color:black;">EDMONTON </a></li> -
                                <li class=""><a href="Calgary" class="city" style="font-weight:bold; color:black;">CALGARY</a></li>


                            ';
                        }
                        

                    }
                    else
                    {
                        echo '

                                <li class="" ><a href="Winnipeg" class="city" style="font-weight:bold; color:#143DF6; border-bottom:1px solid #143DF6; text-decoration:none;">WINNIPEG </a></li> -
                                <li class=""><a href="Edmonton" class="city" style="font-weight:bold; color:black; text-decoration:none;">EDMONTON </a></li> -
                                <li class=""><a href="Calgary" class="city" style="font-weight:bold; color:black; text-decoration:none;">CALGARY</a></li>


                            ';
                    }
                    
                    

                ?>
            </ul>
    
        </div>
    </center>        
    <br><br><br><br>


        <div class="container">

            <div class="row">
                <div class="col-md-7">
                    <div id="map" style="width: 100%; height: 500px; position: relative; bottom:90px;"></div>
                </div>
            <div class="col-md-5" style="position: relative; bottom:90px;">

                <form action="/search_directory" method="get">

                    {{csrf_field()}}

                    <div class="input-group mb-3">

                      <input id="city_click" type="text" name="inpaddress" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button id="submit_google" class="btn btn-primary" type="submit" name="action" readonly="">Find Location</button>
                      </div>
                    </div>

                </form>

                

                <div style="overflow-y: scroll; height:450px;  ">
                    
                    <div class="directory-list" style="">
                        
                        
                                               
                    </div>

                </div>
            </div>

            </div>

               
        </div>
        <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
         <script>

            $(document).ready(function(){
                $.ajax({
                    url:'/api/directory',
                    dataType: "json",
                    contentType: "application/json",
                    success:function(response) {

                        var directories = response[0].directories;
                        var locations = response[0].locations;

                        var markers = [];
                        $.each(locations,function(index,value){

                            var position = new google.maps.LatLng(value.store_lat, value.store_long);
                            var title = value.branch_name;
                            var address = value.store_address;

                            var contentString = "<h5>" + title + "</h5>"  + address  ;

                            var infowindow = new google.maps.InfoWindow({
                              content: contentString
                            });

                            var marker = new google.maps.Marker({

                              position: position,
                              icon: google.maps.marker,
                              map: map,
                              zoom: 12
                              

                            }); 

                             marker.addListener('click', function() {
                                infowindow.open(map, marker);
                              });
                             
                             //Add marker to the array.
                            markers.push(marker);
                             
                              
                          });

                        console.log(locations);
                        $.each(directories, function (index, el) {

                            var stringify_list_directory = jQuery.parseJSON(JSON.stringify(el));
                            var string_branch_name = stringify_list_directory['branch_name'];
                            var string_lat = stringify_list_directory['store_lat'];
                            var string_long = stringify_list_directory['store_long'];
                            var string_address = stringify_list_directory['store_address'];
                            var string_contactnumber = stringify_list_directory['store_contactnumber'];
                            var string_businesshour = stringify_list_directory['store_businesshour'];
                            var string_storeID = stringify_list_directory['id'];
                            var string_storeIMAGE = stringify_list_directory['image'];

                            
                            
                            var directories_data;

                            directories_data = '<p style="font-weight: 300; position: relative; left:10px;" id="location_ids">\
                                <text style="color:black; font-size: 20px; font-weight: bold;">'+string_branch_name+'</text><br>\
                                <button  type="button" name="action" id="addresses" value="'+string_lat+','+string_long+'"><text style="position:relative; right:6px; font-size: 13px;">'+string_address+'</text></button><br>\
                                <text style="font-size: 13px;">'+string_contactnumber+'</text><br>\
                                <text style="font-size: 13px;">'+string_businesshour+'</text><br>\
                                <button style="font-size: 15px;" class="btn btn-primary btn-large" data-toggle="modal" data-target="#myStore'+string_storeID+'">\
                                    Direction <i class="icon ion-md-compass" ></i>\
                                </button>\
                                <div class="modal fade" id="myStore'+string_storeID+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">\
                                  <div class="modal-dialog modal-dialog-centered" role="document">\
                                    <div class="modal-content">\
                                      <div class="modal-header">\
                                        <h5 class="modal-title" id="exampleModalLongTitle">Store Image</h5>\
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                          <span aria-hidden="true">&times;</span>\
                                        </button>\
                                      </div>\
                                      <div class="modal-body">\
                                         <div class="container">\
                                            <div class="row">\
                                                <div class="col-md-12">\
                                                    <img class="card-img-top" src="/storage/'+string_storeIMAGE+'" alt="Card image cap" style="height:200px;">\
                                                   \
                                                </div>\
                                 \
                                            </div>\
                                         </div>\
                                      </div>\
                                    </div>\
                                  </div>\
                                </div>\
                                <hr>\
                            </p>';
                                               
                                              
                           
                            $('.directory-list').append(directories_data);


                            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
  
            
                            var markeronce;

                            $(document).on('click','#addresses',function(e) {

                                //Loop through all the markers and remove
                                for (var i = 0; i < markers.length; i++) {
                                    markers[i].setMap(null);
                                }
                                markers = [];

                                var infowindow = new google.maps.InfoWindow({
                                  content: "<span>Visit us on our store.</span>"
                                });
                                var address_href = $(this).val();
                                var commaPos = address_href.indexOf(',');
                                var coordinatesLat = parseFloat(address_href.substring(0, commaPos));
                                var coordinatesLong = parseFloat(address_href.substring(commaPos + 1, address_href.length));

                                var centerPoint = new google.maps.LatLng(coordinatesLat, coordinatesLong);
                                

                                if (!markeronce) {
                                    markeronce = new google.maps.Marker({
                                        position: centerPoint,
                                        map: map,
                                        zoom: 8

                                    });

                                   
                                } else {
                                    markeronce.setPosition(centerPoint);
                                    
                                }

                                map.setCenter(centerPoint);
                                

                            })

                            

                        }); 

                    },
                    error:function(response) {
                        console.log(response);
                    }
                });
            }); 

            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : sParameterName[1];
                    }
                }
            };

            var tech = getUrlParameter('inpaddress');



            var map;
            function initMap() {
            
            if(tech == 'Winnipeg')
            {
                var myHome = { "lat" : "49.8951" , "long" : "-97.1384" };
            }
            else if(tech == 'Calgary')
            {
                var myHome = { "lat" : "51.0486" , "long" : "-114.0708" };
            }
            else if(tech == 'Edmonton')
            {
                var myHome = { "lat" : "53.5444" , "long" : "-113.4909" };
            }
            else
            {
                var myHome = { "lat" : "49.8951" , "long" : "-97.1384" };
            }
            
            map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: new google.maps.LatLng(myHome.lat, myHome.long),
            mapTypeId: 'roadmap'
            });

            var geocoder = new google.maps.Geocoder();

            document.getElementById('submit_google').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
            });

            var infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map)
            function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function(results, status) {
              if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                  map: resultsMap,
                  position: results[0].geometry.location,
                  icon: google.maps.marker
                });
                  google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                  'Place ID: ' + place.place_id + '<br>' +
                  place.formatted_address + '</div>');
                infowidnow.open(map, this);
              });
              } else {
                alert('Fill the blank');
              }
            });
            }

            

            $(document).ready(function(){
               $('#delete').click(function(){
                    
                })
            })

            $(document).ready(function(){
              $("#city_click").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#location_ids").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });

            
            


       
         }
            
        </script>

        
@endsection