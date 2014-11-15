<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8" />
        <title>
            @section('title')
            @lang('general.site_name')
            @show
        </title>
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="description" content="" />

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS
        ================================================== -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">        
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/custom/agency.css') }}" rel="stylesheet">



        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
        <link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
    </head>

<body id="page-top" class="index">

	

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="/home"><img src="/assets/img/custom/logo.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    
                    

                    <li><a class="page-scroll" href="{{ URL::to('about-us') }}">About ISC</a></li>
                    <li><a class="page-scroll" href="{{ URL::to('contact-us') }}">Contact us</a></li>
                   
                                      
                   
                   
                   @if (Sentry::check())
                   <li><a class="page-scroll"  href="{{ route('logout') }}">Logout</a></li>
                   @else
                  <li><a class="page-scroll" href="{{ route('signin') }}">Login</a></li>
                  <li><a class="page-scroll" href="{{ route('signup') }}">Sign up</a></li>
                  @endif
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    

    <!-- Header -->
    <header>
        <div class="container">
            <div class="page-topper">
            	<!-- Notifications -->
            	    @include('frontend/notifications')  	
                
            </div>
        </div>
    </header>
    
        
    

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
					<!-- Content -->
					@yield('content')
                    
                </div>
            </div>
        </div>
    </section>




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">&copy; UNC Charlotte Institute for Social Capital 2014</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

         
		          
		              
		          	

   



        <!-- Javascripts
        ================================================== -->
        <script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
        
        	<!--new-->
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.dcjqaccordion.2.7.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.scrollTo.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.nicescroll.js') }}"></script>
           
            <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>            
            <script src="{{ asset('assets/js/custom/classie.js') }}"></script>
            <script src="{{ asset('assets/js/custom/cbpAnimatedHeader.js') }}"></script>
            <script src="{{ asset('assets/js/custom/agency.js') }}"></script>
        
        
            <!--common script for all pages-->
            <script type="text/javascript" src="{{ asset('assets/js/custom/common-scripts.js') }}"></script>
        
            <!--script for this page-->
        	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/tasks.js') }}"></script>
        

          <!--/new-->
        
        
        
        @section('body_bottom')
        @show
    </body>
</html>
