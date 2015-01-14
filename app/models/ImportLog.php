<?php

class ImportLog extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tabDataBatch';


	/**
	* Deletes a batch
	*
	* @return bool
	*/
	public function delete()
	{

		// Delete the blog post
		return parent::delete();
	}

}
