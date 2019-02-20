@extends('layouts.navbar')

@section('content')
<div class="background-header">
    <div id="background-content">
        <h2 class="center white-text">Be Updated</h2>
    </div>
</div>

<br><br>
<div class="container">	
  <div class="news_event_content_data"></div>
</div>

<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script>
  var k=localStorage.getItem('_eventID');

    $.ajax({
        url:'http://localhost:8000/api/news_event_content/'+k,
        type:'get',
        dataType: "json",
        contentType: "application/json",
        success:function(response) {


        var news = jQuery.parseJSON(JSON.stringify(response[0].news));
        var first_div_event_title = news[0].content_title;
        var first_div_event_content = news[0].content;
        var first_div_event_file = news[0].file;



        var news_event_content_data;

        news_event_content_data = '<h3>'+first_div_event_title+'</h3><p>'+first_div_event_content+'</p><img src="/storage/'+first_div_event_file+'" style="height:200px; width:300px; -o-object-fit:cover;">'

        $('.news_event_content_data').append(news_event_content_data);

        },
        error:function(response) {
            console.log(response);
        }
    });
</script>

@endsection