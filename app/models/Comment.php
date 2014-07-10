<?php

class Comment extends Elegant
{
    protected $rules = array(
       'comment' => 'required|min:3'
    );

    /**
     * Get the comment's content.
     *
     * @return string
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Get the comment's author.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Get the comment's post's.
     *
     * @return Blog\Post
     */
    public function post()
    {
        return $this->belongsTo('Post');
    }

}
