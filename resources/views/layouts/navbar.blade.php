 <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hiflyer Website</title>
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
        
        <link href="https://fonts.googleapis.com/css?family=Sarabun:300,400,500,600,700" rel="stylesheet">
    <body>

                
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#FFFFFF; z-index:999999999; ">
            
            {{-- <div class="container"> --}}
                    <a class="navbar-brand" href="{{ url('index') }}">
                            <img src="{{asset('/Images/nav-logo.png')}}" height="30" alt="">
                        </a>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                  
                    @if(Request::path() == 'index' || Request::path() == '/')
                       <li class="nav-item {{ Request::path() == 'index' ? 'active' : '' }}"><a href="/index" class="nav-link" style="color:#143DF6 !important; font-weight: bold;">Home</a></li>
                     @else
                        <li class="nav-item {{ Request::path() == 'index' ? 'active' : '' }}"><a href="/index" class="nav-link">Home</a></li>
                     @endif
                    

                    <li class="nav-item dropdown">


                        @if(Request::path() == 'story' || Request::path() == 'community' || Request::path() == 'peoplegallery')
                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            About Us
                            </a>

                        @else
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                            </a>
                       
                        @endif

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('story') }}">Our Company Story</a>
                        <a class="dropdown-item" href="{{ url('community') }}">Community</a>
                        <a class="dropdown-item" href="{{ url('peoplegallery') }}">People Gallery</a>
                    </li>

                     @if(Request::path() == 'news_event')
                       <li class="nav-item"><a href="{{ url('news_event') }}" class="nav-link" style="color:#143DF6 !important; font-weight: bold;">News & Events</a></li>
                     @else
                        <li class="nav-item"><a href="{{ url('news_event') }}" class="nav-link">News & Events</a></li>
                     @endif

 

                    @if(Request::path() == 'directory')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('directory') }}" style="color:#143DF6 !important; font-weight: bold;">Store Directory</a>
                        </li>
                     @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('directory') }}">Store Directory</a>
                        </li>
                     @endif

{{--                      @if(Request::path() == 'online_delivery')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('online_delivery') }}" style="color:#143DF6 !important; font-weight: bold;">Online Delivery</a>
                        </li>
                     @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('online_delivery') }}">Online Delivery</a>
                        </li>
                     @endif --}}

                     @if(Request::path() == 'careers')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('careers') }}" style="color:#143DF6 !important; font-weight: bold;">Careers</a>
                        </li>
                     @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('careers') }}">Careers</a>
                        </li>
                     @endif

                     @if(Request::path() == 'contact')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}" style="color:#143DF6 !important; font-weight: bold;">Contact Us</a>
                        </li>
                     @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                        </li>
                     @endif

                
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                             @if(Request::path() == 'login')
                                <li class="nav-item">
                                  <a class="btn btn-primary" href="{{ url('login') }}" class="btn btn-primary">Login</a>
                                </li>
                             @else
                                <li class="nav-item">
                                <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                                </li>
                             @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     @if(Auth::check())
                                 {{Auth::user()->name}} 
                               @endif <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    
                                    @if(Auth::user())
                                        @if(Auth::user()->role == '3')
                                            <a class="dropdown-item" href="{{ url('customer_data') }}">POS</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>



                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                           <a class="dropdown-item" href="{{ url('hiflyerdashboard') }}">Dashboard</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>



                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @endif
                                    @endif
                                    
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            {{-- </div> --}}
        </nav>


        @yield('content')


        <br><br><br><br>
        <!-- Footer -->
        <footer class="page-footer font-small blue" style="background-color:black; color:white; width:100%;">

          <!-- Copyright -->
          <?php 
            $footersign = "©";
          ?>
          <div class="footer-copyright text-center py-3">{!! $footersign !!} <?php echo date("Y"); ?>
             Hi-Flyer Food. Designed by Solutions Experts and Enablers, Inc.
          </div>
          <!-- Copyright -->

        </footer>
        <!-- Footer -->

    

        <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/popper.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>
        <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('js/sweetalert.min.js')}}"></script>
         <script src="{{asset('js/callback.js')}}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWCz4V5r29GxcGZKNtFzE9v4gOSnKVMYA&libraries=places&callback=initMap"
        async defer></script>

            
        
       <script type="text/javascript">
            $(document).ready(function(){
                    
                   $('.city').click(function(event){
                    event.preventDefault();
                    
                    var city = $(this).attr('href');

                    $('#city_click').val(city);

                   jQuery('#submit_google').click();


                   
                 });

        

             });
       </script>



    </body>
</html>
