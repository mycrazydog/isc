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

	);	

	public static function validate($data)
	{
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

	public static function validateColumns($results, $parent_child)
	{
		$rules_parent = array(
		        'partner_id'   => 'required',
		        'table_name'   => 'required',
				'column_name'   => 'required',
				'data_type'   => 'required',
				'max_length'   => 'required',
				'complete'   => 'required',
				'total_rows'   => 'required',
				'pct_complete'   => 'required',
				'description'   => 'required',
				'batch_id'   => 'required',
			);
	
		$rules_child = array(
		        'partner_id'   => 'required',
		        'table_name'   => 'required',
				'column_name'   => 'required',
				'data_value'   => 'required',
				'data_type'   => 'required',
				'data_label'   => 'required',
				'batch_id'   => 'required',
			);			
			
		if($parent_child == 'file_parent'){
			$rules = $rules_parent;			
		}else{
			$rules = $rules_child;
		}				
	    
	    return Validator::make($results, $rules);	  	    
	}	
	
	public function getCompleteAttribute($value)
	{
		return number_format($value);
	}

	public function getTotalRowsAttribute($value)
	{
		return number_format($value);
	}
}