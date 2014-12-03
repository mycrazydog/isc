<?php

class Status extends Elegant
{
    
	protected $table = 'statuses';    
 /**
  * A post model might have one status
  *
  *
  * @return 
  */    
//    public function post()
//    {
//        return $this->belongsTo('Post');
//    }

	public function posts()
	{
	    return $this->hasMany('Post', 'status_id');
	}

}
