<?php

class AuthController extends BaseController
{
    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignin()
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        // Show the page
        return View::make('frontend.auth.signin');
    }

    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    public function postSignin()
    {
        // Declare the rules for the form validation
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|between:3,32',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput(Input::except('password'))->withErrors($validator);
        }

        try {
            // Try to log the user in
            Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

            // Get the page we were before
            $redirect = Session::get('loginRedirect', 'account');

            // Unset the page we were before from the session
            Session::forget('loginRedirect');

            // Redirect to the users page
            //return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));
            return Redirect::to("/admin/welcome")->with('success', Lang::get('auth/message.signin.success'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account sign up.
     *
     * @return View
     */
    public function getSignup()
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        // Show the page
        return View::make('frontend.auth.signup');
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup()
    {
        // Declare the rules for the form validation
        $rules = array(
            'first_name'       => 'required|min:3',
            'last_name'        => 'required|min:3',
            'email'            => 'required|email|unique:users',
            'email_confirm'    => 'required|email|same:email',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password',

            'evaluate' => 'required',
            'responsible' => 'required',
            'confidential' => 'required',
            'irb' => 'required',
            'benefit' => 'required',
            'credentials' => 'required',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try {
            // Register the user
            $user = Sentry::register(array(
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
            ));

            // Data to be used on the email view
            $data = array(
                'user'          => $user,
                'activationUrl' => URL::route('activate', $user->getActivationCode()),
            );
            
            // Send the activation code through email to site admin
            Mail::send('emails.admin-notify-activate', $data, function ($m) use ($user) {
                $m->to(Config::get('mail.from.address'));
                $m->subject('Account request - ' . $user->first_name);
            });

            // Send email to user letting know the admin is going to review and activate
            Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Pending account request - ' . $user->first_name);
            });





            /***** SUCCESSFUL Register now insert userTerms ******/
            $terms_entry = array(
              'user_id'       => $user->id,
              'funding'       => e(Input::get('funding')),
              'policy'        => e(Input::get('policy')),
              'program'      	=> e(Input::get('program')),
              'evaluate'      => e(Input::get('evaluate')),
              'responsible'  	=> e(Input::get('responsible')),
              'confidential'  => e(Input::get('confidential')),
              'irb'           => e(Input::get('irb')),
              'benefit'       => e(Input::get('benefit')),
              'credentials'		=> e(Input::get('credentials')),
              'website'     	=> e(Input::get('website'))
            );

            DB::table('userTerms')->insert($terms_entry);
            /***********/





            // Redirect to the home page with sucess menu
            return Redirect::to("auth/signin")->with('success', Lang::get('auth/message.signup.success'));

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * User account activation page.
     *
     * @param string $actvationCode
     * @return
     */
    public function getActivate($activationCode = null)
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        try {
            // Get the user we are trying to activate
            $user = Sentry::getUserProvider()->findByActivationCode($activationCode);
            
            

            // Try to activate this user account
            if ($user->attemptActivation($activationCode)) {
            
            	$data = array( 'user' => $user);

                // Send email to user letting know the admin is going to review and activate
                Mail::send('emails.approved-account', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Account approved - ' . $user->first_name);
                });

                // Redirect to the login page
                return Redirect::route('signin')->with('success', Lang::get('auth/message.activate.success'));
            }

            // The activation failed.
            $error = Lang::get('auth/message.activate.error');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $error = Lang::get('auth/message.activate.error');
        }

        // Ooops.. something went wrong
        return Redirect::route('signin')->with('error', $error);
    }

    /**
     * Forgot password page.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        // Show the page
        return View::make('frontend.auth.forgot-password');
    }

    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postForgotPassword()
    {
        // Declare the rules for the validator
        $rules = array(
            'email' => 'required|email',
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password')->withInput()->withErrors($validator);
        }

        try {
            // Get the user password recovery code
            $user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

            // Data to be used on the email view
            $data = array(
                'user'              => $user,
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
            );

            // Send the activation code through email
            Mail::send('emails.forgot-password', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Account Password Recovery');
            });
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return Redirect::route('forgot-password')->with('success', Lang::get('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($passwordResetCode = null)
    {
        try {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

        // Show the page
        return View::make('frontend.auth.forgot-password-confirm');
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  string   $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm($passwordResetCode = null)
    {
        // Declare the rules for the form validation
        $rules = array(
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
        }

        try {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

            // Attempt to reset the user password
            if ($user->attemptResetPassword($passwordResetCode, Input::get('password'))) {
                // Password successfully reseted
                return Redirect::route('signin')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
            } else {
                // Ooops.. something went wrong
                return Redirect::route('signin')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        // Log the user out
        Sentry::logout();

        // Redirect to the users page
        return Redirect::route('signin')->with('success', 'You have successfully logged out!');
    }

}
