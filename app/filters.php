<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/
/*
App::before(function ($request) {
    //
});

App::after(function ($request, $response) {
    //
});
*/
App::before(function($request)
{
    header('Access-Control-Allow-Origin', '*');
    header('Allow', 'GET, POST, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials', 'true');
});


App::after(function($request, $response)
{
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
    $response->headers->set('Access-Control-Allow-Credentials', 'true');
    $response->headers->set('Access-Control-Max-Age','86400');
    return $response;
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
  
    // Check if the user is logged in
    if ( ! Sentry::check()) {
    	// User is not logged in, or is not activated
        
        // Store the current uri in the session
        Session::put('loginRedirect', Request::url());

        // Redirect to the login page
        return Redirect::route('signin');
    }     
});

Route::filter('auth.basic', function () {
    return Auth::basic();
});

/* 
| This was implemented to counter the browser back button. Also see logout route and the getLogout (redirect)
| http://laravel.io/forum/03-22-2014-logged-out-user-goes-back-using-back-button-on-browser
*/
Route::filter('no-cache',function($route, $request, $response){	
	
	$response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
	$response->headers->set('Pragma','no-cache');
	$response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
	
});



/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Admin authentication filter.
|--------------------------------------------------------------------------
|
| This filter does the same as the 'auth' filter but it checks if the user
| has 'admin' privileges.
|
*/

Route::filter('admin-auth', function () {

    // Check if the user is logged in
    if ( ! Sentry::check()) {
        // Store the current uri in the session
        Session::put('loginRedirect', Request::url());

        // Redirect to the login page
        return Redirect::route('signin');
    }

    // Check if the user has access to the admin page
    if ( ! Sentry::getUser()->hasAccess('admin')) {
        // Show the insufficient permissions page
        return View::make('error/403')->with('warning', 'yout cant create roles');
    }
});


/*
|--------------------------------------------------------------------------
| Auth IP Filter
|--------------------------------------------------------------------------
|
| Created to handle API tokens
|
*/

Route::filter('admin-ip', function () {
		
		//isc/app/controllers/HomeController.php
		$iptocheck = Request::getClientIp();	
			
	    /* make a valid ip array to test here and add ip addresses as necessary  */
	    $ipaddresses = array('73.180.236.0/24', '152.15.0.0/16', '10.17.0.0/16');
	    
	    
	    foreach ($ipaddresses as $ipaddress) {
	      if (!restrict_by_ip_cidrcheck($iptocheck, $ipaddress)) {
    
            // Redirect to the login page
            return Redirect::route('dictionary');
	      }
	    }	    

	    	
});

/**
 *
 * @param  Response $iptocheck
 * @param  string   $ipslashcidr
 * @return $this
 *********
 * Check ip address against a network in cidr notation. E.g:
 * _restrict_by_ip_cidrcheck('192.168.10.100','192.168.10.0/24'); returns 1
 * _restrict_by_ip_cidrcheck('192.168.10.100','192.168.12.0/24'); returns 0
 */
function restrict_by_ip_cidrcheck($iptocheck, $ipslashcidr) {
  // Seperate ip address and cidr mask
  $netmask = explode("/", $ipslashcidr);
  // Get valid network as long
  $ip_net = ip2long($netmask[0]);
  // Get valid network mask as long
  $ip_mask = ~((1 << (32 - $netmask[1])) - 1);
  // Get ip address to check as long
  $ip_ip = ip2long($iptocheck);
  // Mask ip address to check to get subnet
  $ip_ip_net = $ip_ip & $ip_mask;
  // Only returns 1 if the valid network
  //and the subnet of the ip address
  //to check are the same
  
  //dd($ip_ip_net == $ip_net);
  
  return ($ip_ip_net == $ip_net);
}








/*
|--------------------------------------------------------------------------
| Auth Token Filter
|--------------------------------------------------------------------------
|
| Created to handle API tokens
|
*/

Route::filter('auth.token', function($route, $request)
{
    $payload = $request->header('X-Auth-Token');

    $userModel = Sentry::getUserProvider()->createModel();

    $user =  $userModel->where('api_token',$payload)->first();

    if(!$payload || !$user) {

        $response = Response::json([
            'error' => true,
            'message' => 'Not authenticated',
            'code' => 401],
            401
        );

        $response->header('Content-Type', 'application/json');
    	
    	return $response;
    }

});






/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});