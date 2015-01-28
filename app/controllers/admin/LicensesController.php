<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use License;
use URL;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use Config;
use Mail;

class LicensesController extends AdminController
{

    protected $license;

      public function __construct(license $license)
      {
          $this->license = $license;
      }

    /**
     * Show a list of all the blog licenses.
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the blog licenses
        $licenses = $this->license->orderBy('created_at', 'DESC')->paginate(10);

        // Show the page
        //return View::make('backend/licenses/index', compact('licenses'));
        //temporary
        return View::make('backend/licenses/welcome');
    }


    /**
    * Blog license welcome.
    *
    * @return View
    */
    public function getWelcome()
    {
      return View::make('backend/licenses/welcome');
    }



    /**
     * Blog license create.
     *
     * @return View
     */
    public function getCreate()
    {
    	return View::make('backend/licenses/create');
    }

    /**
     * Blog license create form processing.
     *
     * @return Redirect
     */
    public function licenseCreate()
    {

         // get the  data
        $new = Input::all();
        $license = new License;

        if ($license->validate($new)) {

             // Update the blog license data
            $license->user_id          = Sentry::getUser()->id;
            $license->licensestatus       	= 'Submitted';
            $license->funding       	= e(Input::get('funding'));
            $license->policy          	= e(Input::get('policy'));
            $license->program      	= e(Input::get('program'));
            $license->evaluate      	= e(Input::get('evaluate'));
            $license->responsible  	= e(Input::get('responsible'));
            $license->confidential  	= e(Input::get('confidential'));
            $license->irb            		= e(Input::get('irb'));
            $license->benefit        	= e(Input::get('benefit'));
            $license->credentials		= e(Input::get('credentials'));
            $license->initial      		= e(Input::get('initial'));


            // Was the blog license created?
            if ($license->save()) {


            	$the_id = $license->id;
            	$the_status = $license->licensestatus;

            	$this->sendMail($the_id, $the_status);

                // Redirect to the new blog license page
                return Redirect::to("admin/dictionary")->with('success', Lang::get('admin/licenses/message.create.success'));
            }

        } else {
            // If validation fails, we'll exit the operation now with errors
            return Redirect::back()->withInput()->withErrors($license->errors());
        }

        // Redirect to the blog license create page
        return Redirect::to('admin/licenses/create')->with('error', Lang::get('admin/licenses/message.create.error'));
    }






    /**
     * Blog license update.
     *
     * @param  int  $licenseId
     * @return View
     */
    public function getEdit($licenseId = null)
    {
        // Check if the blog license exists
        if (is_null($license = $this->license->find($licenseId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/licenses/message.does_not_exist'));
        }

        // Show the page
        return View::make('backend/licenses/edit', compact('license'));
    }





    /**
     * Blog license update form processing page.
     *
     * @param  int      $licenseId
     * @return Redirect
     */
    public function licenseEdit($licenseId = null)
    {
        // Check if the blog license exists
        if (is_null($license = $this->license->find($licenseId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/licenses/message.does_not_exist'));
        }

        // Declare the rules for the form validation
        $rules = array(
            'initial'   => 'required|min:3',
        );


        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Update the blog license data
        $license->licensestatus       	= e(Input::get('licensestatus'));
        $license->funding       	= e(Input::get('funding'));
        $license->policy          	= e(Input::get('policy'));
        $license->program      	= e(Input::get('program'));
        $license->evaluate      	= e(Input::get('evaluate'));
        $license->responsible  	= e(Input::get('responsible'));
        $license->confidential  	= e(Input::get('confidential'));
        $license->irb            		= e(Input::get('irb'));
        $license->benefit        	= e(Input::get('benefit'));
        $license->credentials		= e(Input::get('credentials'));
        $license->initial      		= e(Input::get('initial'));

        // Was the blog license updated?
        if ($license->save()) {
            // Redirect to the new blog license page
            return Redirect::to("admin/licenses/$licenseId/edit")->with('success', Lang::get('admin/licenses/message.update.success'));
        }

        // Redirect to the blogs license management page
        return Redirect::to("admin/licenses/$licenseId/edit")->with('error', Lang::get('admin/licenses/message.update.error'));
    }









    /**
    * Check license status.
    *
    * @param  int  $licenseId
    * @return View
    */
    public function getStatus($licenseId = null)
    {
      // Grab all the blog licenses
      $user = Sentry::getUser()->id;

      $licenses = $this->license->where('user_id', $user)->orderBy('created_at', 'DESC')->paginate(10);



      // Show the page
      return View::make('backend/licenses/status', compact('licenses'));
    }











    /**
     * Delete confirmation for the given blog license.
     *
     * @param  int      $licenseId
     * @return View
     */
    public function getModalDelete($licenseId)
    {
        $model = 'licenses';
        $confirm_route = $error = null;
        // Check if the blog license exists
        if (is_null($license = $this->license->find($licenseId))) {

            $error = Lang::get('admin/licenses/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/license', array('id'=>$license->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }



    /**
     * Delete the given blog license.
     *
     * @param  int      $licenseId
     * @return Redirect
     */
    public function getDelete($licenseId)
    {
        // Check if the blog license exists
        if (is_null($license = $this->license->find($licenseId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/licenses')->with('error', Lang::get('admin/licenses/message.not_found'));
        }

        // Delete the blog license
        $license->delete();

        // Redirect to the blog licenses management page
        return Redirect::to('admin/licenses')->with('success', Lang::get('admin/licenses/message.delete.success'));
    }

        /**
         * Send mail notifying user or admin of license status
         *
         * @return Redirect
         */
        public function sendMail($licenceId, $licensestatus)
        {

        	// Id of user who submitted the license request
        	$user_id = License::select('user_id')->where('id', $licenceId)->first();
        	$user = Sentry::findUserById($user_id->user_id);
        	$user_email = $user->email;

        	$from = Config::get('mail.from');

            if($licensestatus == 'Submitted'){
	            $msgToAdmin = 'A new license request has been submitted. <a href="http://homestead.app:8000/admin/licenses/'. $licenceId .'/view">Click this link to review</a>';
	            $msgToUser = 'Thank you for submitting your license request. We will notify you by email when we have begun processing.';
            }elseif($licensestatus == 'Processing'){
				$msgToAdmin = 'Status changed to processing';
				$msgToUser = 'We have begun processing your request. If we have any questions we will contact you.';
            }elseif($licensestatus == 'Approved'){
            	$msgToAdmin = 'You have approved the license request.<br/> <a href="http://homestead.app:8000/admin/licenses/'. $licenceId . '/view">Click this link to review</a>';
            	$msgToUser = 'Congratulations! Your license request has been approved. We will contact you will with more information soon';
            }

            $combined_arr = array();
            // Data to be used on the email view
        	$data_user = array(
        		'email'				=> $user->email,
        		'description'		=> $msgToUser
        	);

        	$data_admin = array(
        		'email'				=> 'rlawing2@uncc.edu',
        		'description'		=> $msgToAdmin
        	);

        	$combined_arr = array($data_user, $data_admin);
        	//dd($combined_arr);

			foreach ($combined_arr as $row) {
			    //echo $row['email'];
			    //echo $row['description'];

			    Mail::send('emails.license', $row, function ($m) use ($from, $row, $user)
	            {
		        	$m->to($row['email']);
		        	$m->subject('License Submission');
		        	$m->from($from['address'], $from['name']);
		        });
			}

            //foreach($to as $receipt){
                //Mail::queue('mail', array('key' => $todos1), function($message) use ($receipt)
                //Mail::send('mail', array('key' => $todos1), function($message) use ($receipt) {
                //    $message->to($receipt)->subject('Welcome!');
                //});
            //}

			//return Redirect::route('contact-us')->with('success', Lang::get('contact.sent_success'));

        }


}
