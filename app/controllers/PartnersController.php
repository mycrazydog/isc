<?php

class PartnersController extends BaseController
{
    
	protected $post;
	
	public function __construct(Post $post)
	{
		$this->post = $post;
	}   
    
	/**
	 * Partnerspage.
	 *
	 * @return View
	 */
	public function getIndex()
	{
            // Get all the blog posts
            // return $this->post->all();
            //$posts = DB::table('posts')->get();
            /*
            $posts = $this->post->with(array(
                'author' => function ($query) {
                    $query->withTrashed();
                },
            ))->orderBy('created_at', 'DESC');
            
            
            $statuses = DB::table('statuses')->get();                    
    
            return View::make('frontend/partners')->with('posts', $posts)->with('statuses', $statuses);
            */
            
            $statuses = Status::with('posts')->get();
			return View::make('frontend/partners')->with('statuses', $statuses);
            
	}
}
