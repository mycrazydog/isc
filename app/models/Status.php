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

	public function post()
	{
	   return $this->belongsTo('Post','status_id','id');
	}

}
