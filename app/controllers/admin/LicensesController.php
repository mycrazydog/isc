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
use DB;

class LicensesController extends AdminController
{

    protected $license;

    private $license_options;

    public function __construct(license $license)
    {
        $this->license = $license;
        $this->license_options = array('default' => 'Please Select', 'Approved' => 'Approved', 'Processing' => 'Processing', 'Submitted' => 'Submitted', 'Denied' => 'Denied', 'N/A' => 'N/A');
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
        return View::make('backend/licenses/index', compact('licenses'));

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
      //return View::make('backend/licenses/status', compact('licenses'));
      return View::make('backend/licenses/index', compact('licenses'));
    }






    /**
     * Blog license create.
     *
     * @return View
     */
    public function getCreate()
    {
    	//populate the users dropbox
    	$user_options = DB::table('users')->select(DB::raw('concat (first_name," ",last_name) as full_name,id'))->orderBy('id', 'asc')->lists('full_name', 'id');

    	$lo = $this->license_options;

    	return View::make('backend/licenses/create', compact('user_options', 'lo'));
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

        //$validator = Validator::make(Input::all(), $rules);

        //if ($validator->fails())  {
        //    return redirect('register')->withErrors($validator);
        //}

        $license = new License;

        if ($license->validate($new)) {

            // Update the blog license data
            //$license->user_id      = Sentry::getUser()->id;
            $license->user_id        = e(Input::get('user_id'));
            $license->title   			 = e(Input::get('title'));
            $license->irb       	   = e(Input::get('irb'));
            $license->investigator   = e(Input::get('investigator'));
            $license->reviewer       = e(Input::get('reviewer'));
            $license->vote      	   = e(Input::get('vote'));
            $license->establish  	   = e(Input::get('establish'));
            $license->data_extract   = e(Input::get('data_extract'));
            $license->meeting        = e(Input::get('meeting'));
            $license->distribute     = e(Input::get('distribute'));
            $license->complete		   = e(Input::get('complete'));
            $license->notes      		 = e(Input::get('notes'));

	        // Was the blog license created?
	        if ($license->save()) {
	        	$license_id = $license->id;
	        	$license_status = $license->complete;
	        	$this->sendMail($license_id, $license_status);

	            // Redirect to the new blog license page
	            return Redirect::to("admin/licenses/$license_id/edit")->with('success', Lang::get('admin/licenses/message.update.success'));
	        } // END if->save

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

        //populate the users dropbox
        $user_options = DB::table('users')->select(DB::raw('concat (first_name," ",last_name) as full_name,id'))->orderBy('id', 'asc')->lists('full_name', 'id');

        $lo = $this->license_options;

        // Show the page
        return View::make('backend/licenses/edit', compact('license', 'user_options', 'lo'));
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
            'title'   => 'required|min:3',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Update the blog license data
    		$license->user_id        = e(Input::get('user_id'));
    		$license->title   			 = e(Input::get('title'));
    		$license->irb       	   = e(Input::get('irb'));
    		$license->investigator   = e(Input::get('investigator'));
    		$license->reviewer       = e(Input::get('reviewer'));
    		$license->vote      	   = e(Input::get('vote'));
    		$license->establish  	   = e(Input::get('establish'));
    		$license->data_extract   = e(Input::get('data_extract'));
    		$license->meeting        = e(Input::get('meeting'));
    		$license->distribute     = e(Input::get('distribute'));
    		$license->complete		   = e(Input::get('complete'));
    		$license->notes      		 = e(Input::get('notes'));

        // Was the blog license updated?
        if ($license->save()) {
			$license_id = $license->id;
			$license_status = $license->complete;
			$this->sendMail($license_id, $license_status);
            return Redirect::to("admin/licenses/$license_id/edit")->with('success', Lang::get('admin/licenses/message.update.success'));
        }

        // Redirect to the blogs license management page
        return Redirect::to("admin/licenses/$license_id/edit")->with('error', Lang::get('admin/licenses/message.update.error'));
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
    public function sendMail($licenseId, $licensestatus)
    {

    	// Id of user who submitted the license request
    	$user_id = License::select('user_id')->where('id', $licenseId)->first();
    	
    	$license = $this->license->find($licenseId);
    	
    	$user = Sentry::findUserById($user_id->user_id);
    	$user_email = $user->email;

    	//$from = Config::get('mail.from');

        // Data to be used on the email view
        $data = array(
            'user'  => $user->first_name,
            'title' => $license->title,
            'step'	=> $licensestatus,
        );
        
        
        if($licensestatus == 'Submitted'){

        	Mail::send('emails.created-license', $data, function ($m) use ($user) {
        	    $m->to($user->email);
        	    $m->subject('created data license');
        	    $m->from('awill352@uncc.edu', 'awill352@uncc.edu');
        	});     

        }else{

			Mail::send('emails.updated-license', $data, function ($m) use ($user) {
			    $m->to($user->email);
			    $m->subject('updated data license');
			    $m->from('awill352@uncc.edu', 'awill352@uncc.edu');			    
			});  
			
        }

/*
        $combined_arr = array();
        // Data to be used on the email view
    	
    	$data_user = array(
    		'email'				=> $user->email,
    		'description'		=> $msgToUser
    	);

    	$data_admin = array(
    		'email'				=> 'awill352@uncc.edu',
    		'description'		=> $msgToAdmin
    	);

    	$combined_arr = array($data_user, $data_admin);
    	//dd($combined_arr);

		foreach ($combined_arr as $row) {
		   //echo $row['email'];
		   //echo $row['description'];

		    Mail::send('emails.license', $row, function ($m) use ($from, $row, $user) {
	        	$m->to($row['email']);
	        	$m->subject('License Submission');
	        	$m->from($from['address'], $from['name']);
      		});
		}
*/



      //foreach($to as $receipt){
          //Mail::queue('mail', array('key' => $todos1), function($message) use ($receipt)
          //Mail::send('mail', array('key' => $todos1), function($message) use ($receipt) {
          //    $message->to($receipt)->subject('Welcome!');
          //});
      //}

	    //return Redirect::route('contact-us')->with('success', Lang::get('contact.sent_success'));
    }
}
