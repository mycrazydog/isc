<?php

class License extends Elegant
{
    protected $rules = array(
            'initial'   => 'required|min:3',
    );

    /**
     * Deletes a blog license and all the associated comments.
     *
     * @return bool
     */
    public function delete()
    {

        // Delete the license
        return parent::delete();
    }

    /**
     * Returns a formatted license content entry, this ensures that
     * line breaks are returned.
     *
     * @return string
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Return the URL to the license.
     *
     * @return string
     */
    public function url()
    {
        return URL::route('view-license', $this->slug);
    }

    /**
     * Return the current author.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function post()
    {
      //return $this->belongsTo('User', 'user_id');
      return $this->belongsToMany('Post');
    }






}
