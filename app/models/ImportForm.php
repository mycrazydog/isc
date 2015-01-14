<?php

//use functional;
class ImportForm extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'tabDataParent';


	public static $rules = array(
			'file_parent' => 'required',
			'file_child' => 'required',
	);

	public static function validate($data) {

		//request file Type Excel
		Validator::extend('excel', function($attribute, $value, $parameters) {

		//MIME types
			$allowed = array(
				'application/vnd.ms-excel',
				'application/vnd.ms-office',
				'application/msexcel',
				'application/x-msexcel',
				'application/x-ms-excel',
				'application/x-excel',
				'application/x-dos_ms_excel',
				'application/xls',
				'application/x-xls',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'text/html',
			);

			$mime = $value->getMimeType();
			return in_array($mime, $allowed);
		});


		$messages = array(
				'excel' => '*The file field must be a file of type: application/vnd.ms-office (.xls).<br>
				*can add MIME types in <code> /app/models/ImportForm </code> ',
		);

		return Validator::make($data, static::$rules,$messages);

	}

}
