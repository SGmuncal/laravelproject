{{-- @if(Auth::user())
    @if(Auth::user()->role == '3')
        <script>
            window.location.href = "/customer_data";
        </script>
    @endif
@endif --}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Hiflyer Website</title>
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
        <script src="https://cdn.ckeditor.com/4.10.0/basic/ckeditor.js"></script>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        {{-- <link href="https://unpkg.com/ionicons@4.5.0/dist/css/ionicons.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css?family=Sarabun:300,400,500,600,700" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
        
      

        <Style>
          body {
            background-color:#F6F5FD !important;
          }
          .navbar {
                padding: 15px 10px;
                background: #fff;
                border: none;
                border-radius: 0;
                margin-bottom: 40px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            }

            .navbar-btn {
                box-shadow: none;
                outline: none !important;
                border: none;
            }

            .line {
                width: 100%;
                height: 1px;
                border-bottom: 1px dashed #ddd;
                margin: 40px 0;
            }

            i,
            span {
                display: inline-block;
            }

            /* ---------------------------------------------------
                SIDEBAR STYLE
            ----------------------------------------------------- */

            .wrapper {
                display: flex;
                align-items: stretch;
                
            }

            #sidebar {
                min-width: 220px;
                max-width: 220px;
                background: white;
                color: #fff;
                transition: all 0.3s;

            }

            #sidebar.active {
                min-width: 120px;
                max-width: 12px;
                text-align: center;

            }

            #sidebar.active .sidebar-header h3,
            #sidebar.active .CTAs {
                display: none;
            }

            #sidebar.active .sidebar-header strong {
                display: block;
            }

            #sidebar ul li a {
                text-align: left;

            }

            #sidebar.active ul li a {
                padding: 20px 10px;
                text-align: center;
                font-size: 13px;
            }

            #sidebar.active ul li a i {
                margin-right: 0;
                display: block;
               font-size: 17px;
                margin-bottom: 5px;
            }

            #sidebar.active ul ul a {
                padding: 10px !important;
            }

            #sidebar.active .dropdown-toggle::after {
                top: auto;
                bottom: 10px;
                right: 50%;
                -webkit-transform: translateX(50%);
                -ms-transform: translateX(50%);
                transform: translateX(50%);
            }

            #sidebar .sidebar-header {
                padding: 20px;
                /*background: #007BFF;*/
            }

            #sidebar .sidebar-header strong {
                display: none;
                font-size: 1.8em;
                color:black;
            }

            #sidebar ul.components {
                padding: 20px 0;
              /*  border-bottom: 1px solid #47748b;*/
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 13px;
                display: block;

            }

            #sidebar ul li a:hover {
                color: white;
                background: #143DF6;
                text-decoration: none;

            }

            #sidebar ul li a i {
                margin-right: 10px;

            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                font-size:13px;
                background: #143DF6;
            }

            a[data-toggle="collapse"] {
                position: relative;
            }

            .dropdown-toggle::after {
                display: block;
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
            }

            ul ul a {
                font-size: 13px !important;
                padding-left: 30px !important;
            }

            ul.CTAs {
                padding: 20px;
            }

            ul.CTAs a {
                text-align: center;
                font-size: 0.9em !important;
                display: block;
                border-radius: 5px;
                margin-bottom: 5px;
            }

            a.download {
                background: #fff;
                color: #7386D5;
            }

            a.article,
            a.article:hover {
                background: #6d7fcc !important;
                color: #fff !important;
            }

            /* ---------------------------------------------------
                CONTENT STYLE
            ----------------------------------------------------- */

            #content {
                width: 100%;
                padding: 20px;
                min-height: 100vh;
                transition: all 0.3s;
            }

            /* ---------------------------------------------------
                MEDIAQUERIES
            ----------------------------------------------------- */

            @media (max-width: 768px) {
                #sidebar {
                    min-width: 120px;
                    max-width: 120px;
                    text-align: center;
                    margin-left: -80px !important;
                }
                .dropdown-toggle::after {
                    top: auto;
                    bottom: 10px;
                    right: 50%;
                    -webkit-transform: translateX(50%);
                    -ms-transform: translateX(50%);
                    transform: translateX(50%);
                }
                #sidebar.active {
                    margin-left: 0 !important;
                }
                #sidebar .sidebar-header h3,
                #sidebar .CTAs {
                    display: none;
                }
                #sidebar .sidebar-header strong {
                    display: block;
                    color:black;
                }
                #sidebar ul li a {
                    padding: 20px 10px;
                }
                #sidebar ul li a span {
                    font-size: 0.85em;
                }
                #sidebar ul li a i {
                    margin-right: 0;
                    display: block;
                }
                #sidebar ul ul a {
                    padding: 10px !important;
                }
                #sidebar ul li a i {
                    font-size: 1.3em;
                }
                #sidebar {
                    margin-left: 0;
                }
                #sidebarCollapse span {
                    display: none;
                }
            }
        </Style>

    <body>


    @if(Auth::guest())
    {
        <script type="text/javascript">
          window.location = "{{ url('/login') }}";
        </script>
    }

    @endif
        <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><a href="/index"><img src="{{asset('/Images/nav-logo.png')}}" height="30" alt=""></a></h3>
                <strong>HFI</strong>
            </div>

            <ul class="list-unstyled components">
                @if(Auth::user())
                    @if(Auth::user()->role != '3')
                <li class="active">
                    <a href="/hiflyerdashboard">
                        <i class="fas fa-home"></i>

                        Dashboard
                    </a>
                </li>
                       
                @endif
                       @endif
                <li>
                    @if(Auth::user())
                        @if(Auth::user()->role != '3')
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Pages
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('cms_template_home') }}" >Home</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_company_story') }}">Company Story</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_news') }}">News</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_people_gallery') }}">People Gallery</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_directory') }}">Store Directory</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_community') }}">Community</a>
                        </li>
                         <li>
                            <a href="{{ url('cms_template_job') }}">Careers</a>
                        </li>
                        <li>
                            <a href="{{ url('cms_template_slider') }}">Slider</a>
                        </li>
                        <li>
                            <!-- <a href="{{ url('cms_template_menus_choices') }}">Menu</a> -->


                            <div class="list-group list-group-root well">
                              
                                  <a href="#item-1" class="list-group-item" data-toggle="collapse">
                                    Posdata  <i class="fas fa-caret-down"></i>
                                  </a>
                                  <div class="list-group collapse" id="item-1">


                                    <a href="#menu_layout" class="list-group-item" data-toggle="collapse">
                                      <i class="fab fa-buromobelexperte"></i> Menu Layout
                                    </a>
                                    <div class="list-group collapse" id="menu_layout">
                                      <a href="/layout_menu_group" class="list-group-item"><i class="far fa-folder-open"></i> Menu Section</a>
                                      <a href="/layout_sub_menu_group" class="list-group-item"><i class="far fa-folder-open"></i> Menu Sub Group</a>
                                      <a href="/layout_condiments_section" class="list-group-item"><i class="far fa-folder-open"></i> Condiments Section</a>
                                    </div>

                                    <a href="#menu" class="list-group-item" data-toggle="collapse">
                                      <i class="fab fa-buromobelexperte"></i> Menu
                                    </a>

                                    <div class="list-group collapse" id="menu">
                                       <a href="/layout_noun_group"><i class="far fa-folder-open"></i> Noun </a>
                                        <a href="/layout_condiments_group">
                                          <i class="far fa-folder-open"></i> Condiments
                                        </a>
                                        <a href="/layout_chaining_group">
                                          <i class="far fa-folder-open"></i> Chaining
                                        </a>
                                    </div>
                                 
                                    
                                  </div>
                                  
                              
                              
                            </div>
                        </li>
                    </ul>
                      @endif
                       @endif
                        @if(Auth::user())
                            @if(Auth::user()->role == '2')
                            <a href="#pageSubmenus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-users"></i>        
                                Users
                            </a>
                            <ul class="collapse list-unstyled" id="pageSubmenus">
                                
                                <li>
                                    <a href="{{ url('user_management') }}">Management User List</a>
                                </li>
                                 <li>
                                    <a href="{{ url('store_account_list') }}">Store Account List</a>
                                </li>

          
                            </ul>
                            <a href="{{ url('viewapplicants') }}">
                                <i class="far fa-folder-open"></i>      
                                Online Application 
                               
                                
                                <b>({{Session::get('pendingapplicant')}})</b>
                              
                            </a>
                        @endif
                       @endif
                </li>

                @if(Auth::user())
                    @if(Auth::user()->role == '3')
                        <li>
                            <a href="#pageOrdering" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-truck"></i>
                                Delivery Ordering
                            </a>
                            <ul class="collapse list-unstyled" id="pageOrdering">
                                <li>
                                    <a href="{{ url('customer_data') }}" >Ordering</a>
                                </li>
                                <li>
                                    <a href="{{ url('customers_details') }}">Customers Details</a>
                                </li>
                                <li>
                                    <a href="{{ url('delivery_status') }}" >Delivery Status</a>
                                </li>
                                <li>
                                    <a href="{{ url('delivery_driver') }}" >Driver</a>
                                </li>
                            </ul>
                                
                        </li>
                    @endif
                @endif
                @if(Auth::user())
                        @if(Auth::user()->role != '3')
                <li>
                    <a href="{{ url('mails') }}">
                        <i class="fas fa-paper-plane"></i>
                        Mail
                    </a>
                </li>
                 @endif
                    @endif
                {{-- <li>
                    <a href="{{ url('mails') }}">
                        <i class="icon ion-md-card"></i>
                        Report
                    </a>
                </li> --}}
                 <li>
                     <a class="" href="{{ route('logout') }}"
                       onclick="
                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                    </a>
                </li>
            </ul>

            {{-- <ul class="list-unstyled CTAs"> 
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
               
            </ul> --}}
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(120deg, #00e4d0, #5983e8);">
                <div class="container-fluid">

                    
                    <i class="fas fa-align-left" id="sidebarCollapse" style="color:white;"> </i> 
                   
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li>

                              <a href="" style="text-decoration: none; font-size: 15px; color:white;"> 
                               @if(Auth::check())
                                 {{Auth::user()->email}} 
                               @endif
                              <i class="far fa-user-circle"></i></a>
                               
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('admin_content')

       </div>

        
        


        <br><br><br><br>
        <!-- Footer -->
        <footer class="page-footer font-small blue" style="background-color:black; color:white; width:100%;">

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3">© <?php echo date("Y"); ?>
             Hi-Flyer Food. Designed by Solutions Experts and Enablers, Inc.
          </div>
          <!-- Copyright -->

        </footer>
        <!-- Footer -->
        
         <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}" crossorigin="anonymous"></script> 
    
        <script src="{{asset('js/popper.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>

        
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('js/jquery.dataTables.min.js')}}"  crossorigin="anonymous"></script>

        <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"  crossorigin="anonymous"></script>
        


        
        <script src="{{asset('js/sweetalert.min.js')}}"></script>


        <script src="{{asset('js/contentValidation.js')}}"  crossorigin="anonymous"></script>
        <script src="{{asset('js/customerValidation.js')}}"  crossorigin="anonymous"></script>
        <script src="{{asset('js/deliveryMapping.js')}}"  crossorigin="anonymous"></script>



    </body>
</html>
