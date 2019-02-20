<style type="text/css">
	

#columns {
	column-width: 320px;
	column-gap: 15px;
  width: 90%;
	max-width: 1100px;
	margin: 50px auto;
	margin-top: 0px;
}

div#columns figure {
	background: #fefefe;
	border: 2px solid #fcfcfc;
	box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
	margin: 0 2px 15px;
	padding: 15px;
	padding-bottom: 10px;
	transition: opacity .4s ease-in-out;
  display: inline-block;
  column-break-inside: avoid;
}

div#columns figure img {
	width: 100%; height: auto;
	border-bottom: 1px solid #ccc;
	padding-bottom: 15px;
	margin-bottom: 5px;
}

div#columns figure figcaption {
  font-size: .9rem;
	color: #444;
  line-height: 1.5;
}

div#columns small { 
  font-size: 1rem;
  float: right; 
  text-transform: uppercase;
  color: #aaa;
} 

div#columns small a { 
  color: #666; 
  text-decoration: none; 
  transition: .4s color;
}

/*div#columns:hover figure:not(:hover) {
	opacity: 0.4;
}*/

@media screen and (max-width: 750px) { 
  #columns { column-gap: 0px; }
  #columns figure { width: 100%; }
}
</style>

@extends('layouts.navbar')
@section('content')
<div class="background-header">
    <div id="background-content">
        <h2 class="center white-text">People Gallery</h2>
    </div>
</div>
<br><br>
<div class="container">
	<div class="peoplegallery_header"></div>

	<div class="peoplegallery_images">
		<div id="columns"></div>
	</div>
</div>


<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script>
	var k=localStorage.getItem('_albumID');

    $.ajax({
        url:'http://localhost:8000/api/peoplegallery_album/'+k,
        type:'get',
        data:{'album_id':k},
        dataType: "json",
        contentType: "application/json",
        success:function(response) {

            var logic_title = jQuery.parseJSON(JSON.stringify(response[0].logic_title));
    		var first_div_title = logic_title[0].content_title;
    		var first_div_event_place = logic_title[0].event_place;
    		var first_div_event_dated = logic_title[0].event_dated;


    		var peoplegallery_header;

    		peoplegallery_header = '<h3>'+first_div_title+'</h3><p>'+first_div_event_place+'</p><p style="position:relative; bottom:18px;">'+first_div_event_dated+'</p>'

    		$('.peoplegallery_header').append(peoplegallery_header);


    		var get_image_people_gallery = response[0].get_image;
    		$.each(get_image_people_gallery, function (index, el) {

            var stringify_image_people_gallery = jQuery.parseJSON(JSON.stringify(el));
            var peoplegallery_file = stringify_image_people_gallery['image'];

       
            var peoplegallery_images;

            peoplegallery_images = "<div class='thumbnail'><figure><a onclick='window.open('/storage/"+peoplegallery_file+"');return false;'><img src='/storage/"+peoplegallery_file+"'></a></figure></div>";

            $('#columns').append(peoplegallery_images);

        	});

        },
        error:function(response) {
            console.log(response);
        }
    });
</script>
@endsection