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

App::before(function ($request) {
    //
    $clientIP = Request::getClientIp();

    if(!isIPValid($clientIP)) {
    $vip = $clientIP;
        header ( 'Location: http://' . $_SERVER['HTTP_HOST'] . '/error.html#'.$vip );
        exit ();
    }

    function isIPValid($ipaddr) {
        /* make a valid ip array to test here and add ip addresses as necessary  */
        $ip = array('152.15.112.*','152.15.206.*','152.15.112.37', '127.0.0.1', '10.17.14.*', '64.149.141.*');
        //$ip = array('152.15.141.*');
        $ip = str_replace('*', '', $ip);
        for ($i = 0; $i < sizeof($ip); $i++) {
            if (preg_match('/^' . preg_quote($ip[$i], '/') . '/', $ipaddr) > 0) {
              return true;
            }
        }
        return false;
    }


});

App::after(function ($request, $response) {
    //
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
