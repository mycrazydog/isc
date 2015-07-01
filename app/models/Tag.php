<?php

class Tag extends Elegant
{

	protected $table = 'tags';
	/**
	* Get the posts associated with the given tag
	*
	*
	* @return
	*/

	public function posts()
	{
		//return $this->hasMany('Post', 'tags');
		return $this->belongsToMany('Post');
	}

}