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
        <meta name="keywords" content="your, awesome, keywords, here" />
        <meta name="author" content="Jon Doe" />
        <meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS
        ================================================== -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/custom/style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom/style-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom/to-do.css') }}" rel="stylesheet" >
        <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet">

        <style>
        @section('styles')
        body { padding-top: 70px; }
            @media screen and (max-width: 768px) {
                body { padding-top: 0px; }
            }
        /* Set the fixed height of the footer here */
        #footer {

          line-height: 40px;
          background-color: #f5f5f5;
          margin-top: 60px;
          padding-top: 10px;
        }
        @show         
        </style>
        
        <!-- Put these JS files up here for datatable-->
        <script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

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

    <body>


		  <section id="container" >
		      <!-- **********************************************************************************************************************************************************
		      TOP BAR CONTENT & NOTIFICATIONS
		      *********************************************************************************************************************************************************** -->
		      <!--header start-->
		      <header class="header black-bg">
		              <div class="sidebar-toggle-box">
		                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
		              </div>
		            <!--logo start-->
		            <a href="index.html" class="logo"><b>ISC Database</b></a>
		            <!--logo end-->
		            <div class="nav notify-row" id="top_menu">
		
		            </div>
		            <div class="top-menu">            	
		            	
		            	<ul class="nav pull-right top-menu">
		                    @if (Sentry::check())
		                     <li><a class="logout"  href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>
		                     @endif
		            	</ul>
		            			            	          
		            </div>
		        </header>
		      <!--header end-->
		
		      <!-- **********************************************************************************************************************************************************
		      MAIN SIDEBAR MENU
		      *********************************************************************************************************************************************************** -->
		      <!--sidebar start-->
		      <aside>
		          <div id="sidebar"  class="nav-collapse ">
		              
		              <!-- sidebar menu start-->		              
		              <ul class="sidebar-menu" id="nav-accordion">
		              @if (Sentry::check())
		              		
		              	  <p class="centered">
		              	  	<a href="{{ route('profile') }}"><img width="60" src="{{{ Sentry::getUser()->gravatar() }}}" class="img-circle" /></a>
		              	  </p>
		              	  
		              	  <h5 class="centered">Welcome, {{ Sentry::getUser()->first_name }}</h5>
		
		                  <li class="sub-menu"><a class="{{ (Request::is('directory') ? ' active' : '') }}" href="{{ route('directory') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
		                  
                          @if(Sentry::getUser()->hasAccess('posts.write'))
                          <li class="sub-menu"><a class="{{ (Request::is('admin/posts*') ? ' active' : '') }}" href="{{ URL::to('admin/posts') }}"><i class="fa fa-th"></i><span>Manage partners</span></a></li>
              
                          <li class="sub-menu">
                              <a class="{{ (Request::is('admin/users*') ? ' active' : '') }} {{ (Request::is('admin/groups*') ? ' active' : '') }}" href="{{ URL::to('admin/users') }}">
                                  <i class="fa fa-cogs"></i>
                                  <span>Manage users</span>
                              </a>
                              <ul class="sub">
                                  <li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/users') }}">Users</a></li>
                                  <li{{ (Request::is('admin/groups*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/groups') }}">Groups</a></li>
                              </ul>
                          </li>
                          @endif	                  
		                  
		                  
		                  <li class="sub-menu">
								<a class="{{ (Request::is('account*') ? ' active' : '') }}" href="{{ route('account') }}" >
								    <i class="fa fa-cogs"></i>
								    <span>Manage my account</span>
								</a>
		                      <ul class="sub">
		                          <li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}">Edit profile</a></li>
		                          <li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">Change Password</a></li>
		                          <li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">Change Email</a></li>
		                      </ul>
		                  </li>
		                  



		
					  @endif
					  
					  
					  <li class="sub-menu {{ (Request::is('faq') ? ' active' : '') }}"><a href="{{ URL::to('faq') }}"><i class="fa fa-tasks"></i><span>FAQ</span></a></li>
					  <li class="sub-menu"><a href="{{ URL::to('about-us') }}"><i class="fa fa-user"></i><span>About us</span></a></li>
					  <li class="sub-menu"><a href="{{ URL::to('contact-us') }}"><i class="fa fa-envelope"></i><span>Contact us</span></a></li>
					  <li class="sub-menu"><a href="/"><i class="fa fa-home"></i> <span>Homepage</span></a></li>
					  
		              </ul>		              
		              <!-- sidebar menu end-->
		              
		          </div>
		      </aside>
		      <!--sidebar end-->
		
		      <!-- **********************************************************************************************************************************************************
		      MAIN CONTENT
		      *********************************************************************************************************************************************************** -->
		      <!--main content start-->
		      <section id="main-content">
		          <section class="wrapper">         
		          
		              <!-- Notifications -->
		              @include('frontend/notifications')
		          
		              <!-- Content -->
		              @yield('content')
		          	
				</section><! --/wrapper -->
		      </section><!-- /MAIN CONTENT -->
		
		      <!--main content end-->
		
		  </section>
   



        <!-- Javascripts
        ================================================== -->
        
        <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
        
        	<!--new-->
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.dcjqaccordion.2.7.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.scrollTo.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/jquery.nicescroll.js') }}"></script>
            
        
        
            <!--common script for all pages-->
            <script type="text/javascript" src="{{ asset('assets/js/custom/common-scripts.js') }}"></script>
        
            <!--script for this page-->
        	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/tasks.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/custom/modal.js') }}"></script>
            
            
        

          <!--/new-->
        
        
        
        @section('body_bottom')
        @show
    </body>
</html>
