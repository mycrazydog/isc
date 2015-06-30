<?php

class Tag extends Elegant
{

 	protected $table = 'tags';
 /**
  * A post model might have many tags
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
