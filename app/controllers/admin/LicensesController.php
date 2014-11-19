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
        return View::make('backend/licenses/index', compact('licenses'));               
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
                // Redirect to the new blog license page
                return Redirect::to("admin/licenses/$license->id/edit")->with('success', Lang::get('admin/licenses/message.create.success'));
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

}
