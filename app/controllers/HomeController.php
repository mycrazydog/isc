<?php

class HomeController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

//    public function showWelcome()
//    {
//        return View::make('hello');
//    }
    
    public function getIndex()
    {
        
        $clientIP = Request::getClientIp();
    
        if(!$this->isIPValid($clientIP)) {
        $vip = $clientIP;
            header ( 'Location: http://ui.uncc.edu/programs/isc?error='.$vip );
            exit ();
        }
        
        return View::make('frontend/home');
    }
    
    
    public function isIPValid($ipaddr) {
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
    
}
