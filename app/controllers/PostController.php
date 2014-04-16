<?php

class PostController extends BaseController
{

      protected $post;

      public function __construct(Post $post)
      {
          $this->post = $post;
      }

    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Get all the blog posts
        // return $this->post->all();
        $posts = $this->post->with(array(
            'author' => function ($query) {
                $query->withTrashed();
            },
        ))->orderBy('created_at', 'DESC')->paginate();

        return View::make('frontend/posts/index')
          ->with('posts', $posts);

    }

    /**
     * View a blog post.
     *
     * @param  string                $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function getView($slug)
    {
        // Get this blog post data
        $post = $this->post->with(array(
            'author' => function ($query) {
                $query->withTrashed();
            },
            'comments',
        ))->where('slug', $slug)->first();

        // Check if the blog post exists
        if (is_null($post)) {
            // If we ended up in here, it means that a page or a blog post
            // don't exist. So, this means that it is time for 404 error page.
            return App::abort(404);
        }

        // Get this post comments
        $comments = $post->comments()->with(array(
            'author' => function ($query) {
                $query->withTrashed();
            },
        ))->orderBy('created_at', 'DESC')->get();

        // Show the page
        return View::make('frontend/posts/view-post', compact('post', 'comments'));
    }

    /**
     * View a blog post.
     *
     * @param  string   $slug
     * @return Redirect
     */
    public function postView($slug)
    {
        // The user needs to be logged in, make that check please
        if ( ! Sentry::check()) {
            return Redirect::to("blog/$slug#comments")->with('error', Lang::get('post.messages.login'));
        }

        // Get this blog post data
        $post = $this->post->where('slug', $slug)->first();

        // get the  data
        $new = Input::all();
        $comment = new Comment;

        // If validation fails, we'll exit the operation now
        if ($comment->validate($new)) {
            // Save the comment
            $comment->user_id = Sentry::getUser()->id;
            $comment->content = e(Input::get('comment'));

                // Was the comment saved with success?
                if ($post->comments()->save($comment)) {
                    // Redirect to this blog post page
                    return Redirect::to("blog/$slug#comments")->with('success', 'Your comment was successfully added.');
                }

        } else {
            // failure, get errors
            return Redirect::to("blog/$slug#comments")->withInput()->withErrors($comment->errors());
        }

        // Redirect to this blog post page
        return Redirect::to("blog/$slug#comments")->with('error', Lang::get('post.messages.generic'));

    }

}
