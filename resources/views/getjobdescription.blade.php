@extends('layouts.navbar')

@section('content')

<br><br><br><br><br>
<form method="get" action="/getjobdescription">
  <div class='container' id="job_position_content">

  </div>

</form>

<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script>
  var k=localStorage.getItem('_positionID');

    $.ajax({
        url:'http://localhost:8000/api/getjobdescription/'+k,
        type:'get',
        dataType: "json",
        contentType: "application/json",
        success:function(response) {
       
        var get_data_job = jQuery.parseJSON(JSON.stringify(response.get_data_job));



        var first_div_position_name = get_data_job[0].position_name;
        var first_div_location = get_data_job[0].location;
        var first_div_position_desc = get_data_job[0].position_desc;
        var first_div_position_requirements = get_data_job[0].position_requirements;
        var first_div_position_id = get_data_job[0].id;
        


        var job_position_content;
        
        job_position_content = '<div class="collection">\
          <a style="color:black; font-size:25px;">'+first_div_position_name+'\
            <b>- '+first_div_location+'</b>\
          </a>\
        </div>\
          <br>\
          <p>\
            <b>Position Description</b> <br>\
            '+first_div_position_desc+'\
          </p>\
          <p>\
            <br>\
            <b>Position Requirements</b> <br>\
            '+first_div_position_requirements+'\
          </p>\
          <a href="/onlineapplication/'+first_div_position_id+'" class="btn btn-large btn-primary float-right" id="history-read-more"> Apply</a>\
         <br><br><br>';

        $('#job_position_content').append(job_position_content);


        },
        error:function(response) {
            console.log(response);
        }
    });
</script>
@endsection