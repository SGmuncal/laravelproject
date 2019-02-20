        

if (navigator.geolocation) {  
    navigator.geolocation.getCurrentPosition(success);  
} else {  
    alert("There is Some Problem on your current browser to get Geo Location!");  
}  

function success(position) {  
    var lat = position.coords.latitude;  
    var long = position.coords.longitude;  
    var city = position.coords.locality;  
    var LatLng = new google.maps.LatLng(lat, long);  
    var mapOptions = {  
        center: LatLng,  
        zoom: 2,  
        mapTypeId: google.maps.MapTypeId.ROADMAP  
    };  

    var map = new google.maps.Map(document.getElementById("MyMapLOC"), mapOptions);  
    var marker = new google.maps.Marker({  
        position: LatLng,  
        title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: "  
                    + lat + +"<br />Longitude: " + long  
    });  

    marker.setMap(map);  
    var getInfoWindow = new google.maps.InfoWindow({ content: "<b>Your Current Location</b><br/> Latitude:" +  
                            lat + "<br /> Longitude:" + long + ""  
    });  
    getInfoWindow.open(map, marker);  
}  

function SearchRoute() {  
    document.getElementById("MyMapLOC").style.display = 'none';  

    var markers = new Array();  
    var myLatLng;  

    //Find the current location of the user.  
    if (navigator.geolocation) {  
        navigator.geolocation.getCurrentPosition(function(p) {  
            var myLatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);  
            var m = {};  
            m.title = "Your Current Location";  
            m.lat = p.coords.latitude;  
            m.lng = p.coords.longitude;  
            markers.push(m);  

            //Find Destination address location.  
            var address = document.getElementById("txtDestination").value;  
            var geocoder = new google.maps.Geocoder();  
            geocoder.geocode({ 'address': address }, function(results, status) {  
                if (status == google.maps.GeocoderStatus.OK) {  
                    m = {};  
                    m.title = address;  
                    m.lat = results[0].geometry.location.lat();  
                    m.lng = results[0].geometry.location.lng();  
                    markers.push(m);  
                    var mapOptions = {  
                        center: myLatLng,  
                        zoom: 2,  
                        mapTypeId: google.maps.MapTypeId.ROADMAP  
                    };  
                    var map = new google.maps.Map(document.getElementById("MapRoute"), mapOptions);  
                    var infoWindow = new google.maps.InfoWindow();  
                    var lat_lng = new Array();  
                    var latlngbounds = new google.maps.LatLngBounds();  

                    for (i = 0; i < markers.length; i++) {  
                        var data = markers[i];  
                        var myLatlng = new google.maps.LatLng(data.lat, data.lng);  
                        lat_lng.push(myLatlng);  
                        var marker = new google.maps.Marker({  
                            position: myLatlng,  
                            map: map,  
                            title: data.title  
                        });  
                        latlngbounds.extend(marker.position);  
                        (function(marker, data) {  
                            google.maps.event.addListener(marker, "click", function(e) {  
                                infoWindow.setContent(data.title);  
                                infoWindow.open(map, marker);  
                            });  
                        })(marker, data);  
                    }  
                    map.setCenter(latlngbounds.getCenter());  
                    map.fitBounds(latlngbounds);  

                    //***********ROUTING****************//  

                    //Initialize the Path Array.  
                    var path = new google.maps.MVCArray();  

                    //Getting the Direction Service.  
                    var service = new google.maps.DirectionsService();  

                    //Set the Path Stroke Color.  
                    var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });  

                    //Loop and Draw Path Route between the Points on MAP.  
                    for (var i = 0; i < lat_lng.length; i++) {  
                        if ((i + 1) < lat_lng.length) {  
                            var src = lat_lng[i];  
                            var des = lat_lng[i + 1];  
                            path.push(src);  
                            poly.setPath(path);  
                            service.route({  
                                origin: src,  
                                destination: des,  
                                travelMode: google.maps.DirectionsTravelMode.DRIVING  
                            }, function(result, status) {  
                                if (status == google.maps.DirectionsStatus.OK) {  
                                    for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {  
                                        path.push(result.routes[0].overview_path[i]);  
                                    }  
                                } else {  
                                    alert("Location is to far can't locate");  
                                    
                                }  
                            });  
                        }  
                    }  
                } else {  
                    alert("Request failed.")  
                }  
            });  

        });  
    }  
    else {  
        alert('Some Problem in getting Geo Location.');  
        return;  
    }  
}


var append_address_to_textbox = $('#append_address_to_textbox').text();
var txtDestination = $('input#txtDestination').val(append_address_to_textbox);
if(txtDestination == '')
{

}
else
{
    jQuery('#automatic_click_map_customer').click();
}


$(document).ready(function() {

//deliver button
$('#deliver_button').click(function(){
    var customer_order_id = $(this).attr('data-order-id');
    var deliver_value = 'Delivered';
    var cancel_value = 'Cancelled';
    $.ajax({
        url:'/order_status_update',
        type:'post',
        data:{deliver_status:deliver_value,order_id:customer_order_id},
        success:function(data){
            swal({
              title: "Are you sure?",
              text: "Once this clicked, you will not be able to update this!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Successfully Order Delivered!", {
                  icon: "success",
                });
              } else {
                swal("Cancelled");
              }
            });
        },
        error:function(data){
            console.log(data);
        }
    });
});

//cancel Button
$('#deliver_cancel_button').click(function(){
    var customer_order_id = $(this).attr('data-order-id');
    var deliver_value = 'Delivered';
    var cancel_value = 'Cancelled';
    $.ajax({
        url:'/order_status_update',
        type:'post',
        data:{cancelled_status:cancel_value,order_id:customer_order_id},
        success:function(data){
           swal({
              title: "Are you sure?",
              text: "Once this clicked, you will not be able to update this!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Successfully Order Cancelled!", {
                  icon: "success",
                });
              } else {
                swal("Cancelled");
              }
            });
        },
        error:function(data){
            console.log(data);
        }
    });
});



}); 