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
                <a class="navbar-brand page-scroll" href="#page-top"><img src="/assets/img/custom/logo.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    
                    
					<li><a class="page-scroll" href="{{ URL::to('about-us') }}">About ISC</a></li>
                    <li><a class="page-scroll" href="{{ URL::to('faq') }}">FAQ</a></li>
                    <li><a class="page-scroll" href="{{ URL::to('contact-us') }}">Contact us</a></li>
                   
                                      
                   
                   
                   @if (Sentry::check())
                   <li><a class="page-scroll"  href="{{ route('logout') }}">Logout</a></li>
                   @else
                  <li><a href="{{ route('signin') }}">Login</a></li>
                  <li><a href="{{ route('signup') }}">Sign up</a></li>
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
            <div class="intro-text">
            	<!-- Notifications -->
            	    @include('frontend/notifications')
            	
                <div class="intro-lead-in">Welcome to The Institute for Social Capital<br/> Database Information Portal</div>
                <div  class="intro-heading" style="font-size:23px;line-height:40px;">Our online information portal where you can access our data dictionary and download our data license request form. </div>
                <a href="FAQ" class="page-scroll btn btn-xl btn-yellow">Learn more</a>
                <a href="{{ route('signup') }}" class="page-scroll btn btn-primary btn-xl">Request access</a>
            </div>
        </div>
    </header>
    
        
    

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About the ISC</h2>
                    <h3 class="section-subheading text-muted">The ISC’s mission is to advance university research and increase the community’s capacity for data-based planning and evaluation.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">The value of data sharing</h4>
                    <p class="text-muted">To best serve vulnerable individuals within our community, we must communicate across the silos of data created by governmental and community agencies.
Sharing creates more accurate evaluation of policy options, improved stewardship of taxpayer dollars, reduced paperwork burdens, and more coordinated delivery of public services.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Integrated data system</h4>
                    <p class="text-muted">An integrated data system holds administrative data from numerous organizations and can match information across these organizations at the individual level.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Data protection</h4>
                    <p class="text-muted">All data released from the ISC Community Database are de-identified and aggregated.
The ISC Data and Research Oversight Committee (DAROC) always includes a member of the agency whose data is requested for research. This member approves data request and data set before release to the researcher.</p>
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
