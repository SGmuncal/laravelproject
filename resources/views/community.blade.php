@extends('layouts.navbar')

@section('content')

<div class="jumbotron"  style="background-image: url('./Images/charity.jpg'); height:600px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;">
</div>
   
<div id="mission-vision-section">
    <div class="jumbotron" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
        <h1 class="display-4" id="first_div_header"></h1>
        <p class="lead" id="first_div_content"></p>           
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="" id="community_first_button" role="button" style="color:white;">Read more</a>
        </p>
    </div>
</div>

<div id="directory">
    <div class="container">
       <div class="row">
            <div class="col-md-5">
                <h1 id="second_div_header"></h1>
                <p id="second_div_content"></p>
                <a class="btn btn-primary btn-lg" id="community_second_button" href="" role="button">Read More</a>
            </div>
            <div class="col-md-6" id="second_div_image">
                
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div id="directory">
    
       <iframe width="100%" name="someFrame" id="someFrame" height="405" src="https://www.youtube.com/embed/IQWq4qU1F74" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="z-depth-5"></iframe>
       <ul class="list-inline" id="community_videos">
        
              
       </ul> 
         
      </div>

    </div>

    <div class="col-md-6">
        <div id="directory">
          
            <div class="col-md-12">
                <h1 id="fourth_div_header"></h1>
                <p id="fourth_div_content"></p>
                <a class="btn btn-primary btn-lg" id="community_fourth_button" href="" role="button">Read More</a>
                
            </div>
          
        </div>
    </div>
  </div>
</div>





<center>
<div id="directory">
  <ul class="list-inline" id="foundation_image_list">
  </ul>
</div>
</center>
@endsection

