@extends('layouts.navbar')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
        <div class="carousel-item active" id="active_slider">
        </div>
        
        
        <div class="carousel-item" id="non_active_slider">
            
        </div>
       

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end section -->

<br><br><br><br><br><br>

<div class="jumbotron" style="box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1)">
<center>

<div class="container">
    <div class="row">
        
       
        <div class="col-md-6">
                
                <div id="mission-vision-section">
               
                    <h1 class="display-4" id="mission_header" style="font-size:45px;"></h1>
             
                    <p class="lead" id="mission_content" style="font-size:20px;"></p>
                
                </div>
      
        </div>


        <div class="col-md-6">
           
    
                <div id="mission-vision-section">
                   
                    <h1 class="display-4" id="vision_header" style="font-size:45px;"></h1>
             
                    <p class="lead" id="vision_content" style="font-size:20px;"></p>
                
                </div>
       
        </div>

    </div>
</div>
</center>
</div>
<!-- end section -->
<br><br><br><br><br><br>
<center>   
    <div class="jumbotron" style="background-color:white;">
        <h1 style="">Get your favourite food.</h1>
        <h4>in 3 Simple Steps.</h4>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <i class="icon ion-md-locate" style="font-size:45px; color:black;"></i>
                    <h4>Discover</h4>
                    <p>Find restaurants that deliver to you by selecting your city.</p>
                </div>
                <div class="col-md-4">
                    <i class="icon ion-md-pizza" style="font-size:45px; color:black;"></i>
                    <h4>Choose</h4>
                    <p>Browse hundreds of menus to find the best food you like.</p>
                </div>
                <div class="col-md-4">
                    <i class="icon ion-md-cube" style="font-size:45px; color:black;"></i>
                    <h4>Deliver</h4>
                    <p>Food is prepared & delivered to your door ASAP</p>
                </div>
            </div>
        </div>
    </div>
</center>

<br><br><br><br><br><br>

<div class="jumbotron" style="box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1)">
    <div class="text-center">
            <h2 style="font-size:45px; " id="career_header"></h2>
             <h4 style="font-size:35px; font-weight: 300; " id="career_content"></h4>
             <a class="btn btn-primary btn-lg" id="btn_position_here" style="color:white;" href="" role="button">See positions here</a>
    </div>
</div>



<div id="directory">
    <div class="container">
         <div class="row">
            <div class="col-md-6">
                <h1 style="" id="store_header"></h1>
                <h4 style="font-size:20px; font-weight: 300" id="store_content"></h4>

                <a class="btn btn-primary btn-lg" id="btn_visit_us" style="color:white;" href="" role="button">Visit Us</a>  
            </div>

            <div class="col-md-5">
                
                <div id="store_directory_image"></div>

            </div>
        </div>  
        
    </div>
</div>
