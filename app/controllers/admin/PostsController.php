<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Post;
use URL;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use Status;
use Tag;

class PostsController extends AdminController
{

    protected $post;

      public function __construct(Post $post)
      {
          $this->post = $post;
      }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the blog posts
        $posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

		//Log::info('This is some useful information-');
        // Show the page
        return View::make('backend/posts/index', compact('posts'));

    }

    /**
     * Blog post create.
     *
     * @return View
     */
    public function getCreate()
    {

        //$status_options = Status::lists('status', 'id');        
        //$available_tags = Tag::lists('name', 'id'));       

        return View::make('backend/posts/create');
		//->with('status_options',$status_options)->with('available_tags',$available_tags)
		
		
    	 	/*

    	 	WES CODE TO COME BACK TO
    		//Individual permission check
    		if ( Sentry::getUser()->hasAnyAccess(['posts.create']) )
    		{
    		   //They do have access
    		   return Redirect::to('admin/posts')->with('error', 'This individual does not have the proper permissions');
    		}else{
    			//They do NOT have access
    		}



    		//Group permission check
    		// Find the user using the user id
    	    $user = Sentry::getUser();

    	    // Find the group
    	    $admin = Sentry::findGroupByName('Admin');
    	    $authors = Sentry::findGroupByName('Authors');

    	    // Check if the user is in the administrator or authors group
    	    if (($user->inGroup($admin)) || ($user->inGroup($authors)))
    	    {
			    // Show the page
			    return View::make('backend/posts/create');
			    //return Redirect::to('admin/posts')->with('error', $user.'<hr>'.$admin);
			}else {
				return Redirect::to('admin/posts')->with('error', Lang::get('general.denied'));
			}*/



    }

    /**
     * Blog post create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {

         // get the  data
        $new = Input::all();
        $post = new Post;

        if (Input::get('slug')) {
            Input::merge(array('slug' => Input::get('slug')));
        } else {
            Input::merge(array('slug' => Str::slug(Input::get('title'))));
        }


        if ($post->validate($new)) {

             // Update the blog post data
            $post->title            = e(Input::get('title'));
            $post->slug             = e(Input::get('slug'));
            
            /*
            // Not needed because we create a post with just title to be able to go ahead and get the post-id
            $post->content          = e(Input::get('content'));
            
            $post->meta_title       = e(Input::get('meta-title'));
            $post->meta_description = e(Input::get('meta-description'));
            $post->meta_keywords    = e(Input::get('meta-keywords'));
            $post->user_id          = Sentry::getUser()->id;
            $post->partnerwebsite   = e(Input::get('partnerwebsite'));
            $post->status_id        = e(Input::get('status'));
            $post->tags           	= e(Input::get('tags'));
            $post->yearsavailable   = e(Input::get('yearsavailable'));
            $post->notescleaning    = e(Input::get('notescleaning'));
            //$post->notessource      = e(Input::get('notessource'));
            $post->notesversion     = e(Input::get('notesversion'));

            if (Input::hasFile('filePartnerLogo')) {
            	$file = Input::file('filePartnerLogo');
            	$name = 'filePartnerLogo-' . $file->getClientOriginalName();
            	$file = $file->move(base_path('public/logos'), $name);
            	$post->filePartnerLogo = $name;
            }
            */


            // Was the blog post created?
            if ($post->save()) {
                // Redirect to the new blog post page
                return Redirect::to("admin/posts/$post->id/edit")->with('success', Lang::get('admin/posts/message.create.success'));
            }

        } else {
            // If validation fails, we'll exit the operation now with errors
            return Redirect::back()->withInput()->withErrors($post->errors());
        }

        // Redirect to the blog post create page
        return Redirect::to('admin/posts/create')->with('error', Lang::get('admin/posts/message.create.error'));
    }

    /**
     * Blog post update.
     *
     * @param  int  $postId
     * @return View
     */
    public function getEdit($postId = null)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/posts/message.does_not_exist'));
        }

        $status_options = Status::lists('name', 'id');
        $tags = Tag::lists('name', 'id');  
        $selected_tags =  $post->tags->lists('id');
        
        // Show the page
        return View::make('backend/posts/edit', compact('post'))->with('status_options',$status_options)->with('tags',$tags)->with('selected_tags', $selected_tags);
    }

    /**
     * Blog Post update form processing page.
     *
     * @param  int      $postId
     * @return Redirect
     */
    public function postEdit($postId = null)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/posts/message.does_not_exist'));
        }

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'slug'   => "unique:posts,id,$postId",
            'content' => 'required|min:3',
        );

        if (Input::get('slug')) {
            Input::merge(array('slug' => Input::get('slug')));
        } else {
            Input::merge(array('slug' => Str::slug(Input::get('title'))));
        }

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }



        // Update the blog post data
        $post->title            = e(Input::get('title'));
        $post->slug             = e(Input::get('slug'));
        $post->content          = e(Input::get('content'));
        $post->meta_title       = e(Input::get('meta-title'));
        $post->meta_description = e(Input::get('meta-description'));
        $post->meta_keywords    = e(Input::get('meta-keywords'));
        $post->partnerwebsite   = e(Input::get('partnerwebsite'));
        $post->status_id           = e(Input::get('status_id'));              
        
        //$comma_tags =implode(",", e(Input::get('tags')));            
        //$post->tags         = $comma_tags;            
        //$post->tags = implode(',', Input::get('tags'));  
        
        //$tagIds = Input::get('tags');
         if (Input::get('tag_list')) {
        	$post->tags()->sync(Input::get('tag_list'));  
        }     
                
        
        $post->yearsavailable   = e(Input::get('yearsavailable'));
        $post->notescleaning    = e(Input::get('notescleaning'));
        //$post->notessource      = e(Input::get('notessource'));
        $post->notesversion     = e(Input::get('notesversion'));

        if (Input::hasFile('filePartnerLogo') && $this->correct_size(Input::file('filePartnerLogo'))) {        	    
        	$file = Input::file('filePartnerLogo');
        	$name = 'filePartnerLogo-' . $file->getClientOriginalName();
        	$file = $file->move(base_path('public/logos'), $name);
        	$post->filePartnerLogo = $name;        	     	
        }

        // Was the blog post updated?
        if ($post->save()) {
        	//$post->status()->sync(Input::get('status'));
            // Redirect to the new blog post page
            return Redirect::to("admin/posts/$postId/edit")->with('success', 'Updated successfully');
        }

        // Redirect to the blogs post management page
        return Redirect::to("admin/posts/$postId/edit")->with('error', Lang::get('admin/posts/message.update.error'));
    }

    /**
     * Delete confirmation for the given blog post.
     *
     * @param  int      $postId
     * @return View
     */
    public function getModalDelete($postId)
    {
        $model = 'posts';
        $confirm_route = $error = null;
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {

            $error = Lang::get('admin/posts/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/post', array('id'=>$post->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given blog post.
     *
     * @param  int      $postId
     * @return Redirect
     */
    public function getDelete($postId)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/posts')->with('error', Lang::get('admin/posts/message.not_found'));
        }

        // Delete the blog post
        $post->delete();

        // Redirect to the blog posts management page
        return Redirect::to('admin/posts')->with('success', Lang::get('admin/posts/message.delete.success'));
    } 
    
    
    public function correct_size($photo) {
        $maxHeight = 250;
        $maxWidth = 250;
        list($width, $height) = getimagesize($photo);
        return ( ($width <= $maxWidth) && ($height <= $maxHeight) );
    }   


}
