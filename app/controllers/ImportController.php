<?php

//use Maatwebsite\Excel\Excel;
//use Illuminate\Redis\Database;

class ImportController extends BaseController 
{
	
	/**
	 * Returns all the blog graph.
	 *
	 * @return View
	 */
	public function getImport() {
			
		//init
		//ImportPreview::truncate();// Remove all of 'tbl_temp_measurement' table for preview
		//DB::table('tbl_missing_measurement')->truncate();
		
		Session::forget('FRIST_DATE'); //for missing row	
		
		// send message if upload success
		if (!empty(Session::get('success'))) {
			$message = Session::get('success');				
		}		
		// default message for get /import
		else { 
			$message ="<div class='alert alert-info' role='alert'>Please select a file</div>";
		}
		
		$this->Clear();//Remove all Tempfile and Session		
		
		//populate the partner dropbox
		$partner_options = DB::table('posts')->orderBy('title', 'asc')->lists('title','id');			

		// Render Import
		return View::make('backend/import.import', array('partner_options' => $partner_options))->with('message',$message);
	}
	
	
	/**
	 * Imports spreadsheet
	 *
	 */
public function postImport() {

	
	
	//check input paramiter or file type input		
   $validator = ImportForm::validate(Input::all());
   
    if($validator->fails()) {
		//if file display error message
		return View::make('backend/import.import')->withErrors($validator)->with('message',' ');			
	}
	
				
	
	//EXCEL Import		
	if ($validator->passes() && Input::file('file')->getMimeType() == "application/vnd.ms-excel") {	
	
		
	
		//Create a batch and get it's id
		$user_id = Sentry::getUser()->id;
		$partner_id = e(Input::get('partner_id'));
		$batch_description = e(Input::get('batch_description'));			
		$batch_id = $this->createBatch($user_id, $partner_id, $batch_description);

		//Handle the file
		$file = Input::file('file');
		$fileName = $this->checkName($file->getClientOriginalName(),'xls');
		Session::put('filename',$fileName);
		Input::file('file')->move( base_path('temp'),$fileName); // import to temp folder
		
		
		
		$results0 = Excel::selectSheetsByIndex(0)->load(base_path('temp/'.$fileName), function($reader) {
		})->get()->toArray();//end Excel::load
		
		$results1 = Excel::selectSheetsByIndex(1)->load(base_path('temp/'.$fileName), function($reader) {
		})->get()->toArray();//end Excel::load
		
		
			/////////////////
			$arr0 = array();
			$arr1 = array();
		
			try {
				
				////////////////////////////////////////////////////////////////////////////////////////////////
				foreach ($results0 as $value) {				 						 	
					 	$temp0 = array(						 	
								'table_name'  => trim($value['table_name']),
								'column_name' 	  => trim($value['column_name']),
								'system_data_type' 	  => $value['system_data_type'],
								'max_length' 		  => $value['max_length'],
								'precision' 	  => $value['precision'],
								'complete'      => $value['complete'],
								'percentage'	  => $value['percentage'],
								'batch_id'		=> $batch_id
					 	);					 						 				 	
					 	$arr0[$value['table_name']][] = $temp0;				 		
				}//end foreach
				foreach ($results1 as $value) {				 						 	
					 	$temp1 = array(						 	
					 			'table_name'  => trim($value['table_name']),
					 			'column_name' 	  => trim($value['column_name']),
					 			'data_value' 	  => $value['data_value'],
					 			'batch_id'		=> $batch_id
					 	);					 						 				 	
					 	$arr1[$value['table_name']][] = $temp1;				 		
				}//end foreach
				/////////////////////////////////////////////////////////////////////////////////////////////////						
				
				 	try {
				 					 					 	
				 		//dd($arr0);
				 		//Log::info('This is some useful information-');	
				 		
				 		//insert all data
				 		foreach ($arr0 as $station => $value) {					 			
				 			DB::table('tabDataParent')->insert($value);				 			 			
				 		} //end foreach
			 			foreach ($arr1 as $station => $value) {					 			
			 				DB::table('tabDataChild')->insert($value); 	
			 			} //end foreach
				 		
				 	}// end inner-try 
				 	catch (Exception $e) {	 			 	
					 	// Problem inserting values
					 	return Redirect::to('import')->with('message' , 'problem inserting values');	
				 	}//end inner-catch
				 						 	
			}//end outer-try
			catch (Exception $e){
				// file incorrect
				return Redirect::to('import')->with('message' , 'file incorrect');				
			}//end outer-catch	
		
		$distinct_check =$this->getDistinct($batch_id);		
		
		return View::make('backend/import.preview')->with('fileName','<code>'.$fileName.'</code>')->with('batch_id',$batch_id)->with('distinct_check',$distinct_check);			
	
	}//end if-validator
			
}//end function postImport
                         
	


	/**
	 * Returns data from import to preview
	 *
	 */
	public function getData()
	{
		
			$data = DB::table('tbl_temp_measurement');
//				->leftJoin('tbl_rain_station',
//				'tbl_temp_measurement.station_id','=','tbl_rain_station.stationid')
//				->leftJoin('tbl_source',
//						'tbl_temp_measurement.source','=','tbl_source.source_id')
//				->select(array(						
//				'tbl_temp_measurement.meas_id',
//				'tbl_temp_measurement.meas_date',
//				'tbl_temp_measurement.station_id',
//				'tbl_rain_station.name',		
//				'tbl_temp_measurement.max_temp',
//				'tbl_temp_measurement.min_temp',
//				'tbl_temp_measurement.rain',
//				'tbl_temp_measurement.avgrh',
//				'tbl_temp_measurement.evapor',
//				'tbl_temp_measurement.mean_temp',
//				'tbl_source.source_name'										
//
//		));

		return  Datatables::of($data)->make();
	}
	

	
	
//	public function pushMissing($station,$format)
//	{
//		
//	
//		if($format == 'xls') {
//				$sql = "INSERT INTO tbl_missing_measurement(
//       		dt,meas_date, station_id, max_temp, min_temp, rain, avgrh, evapor, 
//       		mean_temp,meas_year,meas_month,meas_day, source )
//
//			(select calendar_table.dt, 
//				tbl_temp_measurement.meas_date,".$station.",
//				tbl_temp_measurement.max_temp,tbl_temp_measurement.min_temp,tbl_temp_measurement.rain,
//				tbl_temp_measurement.avgrh,tbl_temp_measurement.evapor,tbl_temp_measurement.mean_temp,
//				tbl_temp_measurement.meas_year,tbl_temp_measurement.meas_month,tbl_temp_measurement.meas_day,
//				tbl_temp_measurement.source
//				
//				FROM calendar_table LEFT JOIN tbl_temp_measurement on
// 				tbl_temp_measurement.meas_date = calendar_table.dt
// 				WHERE calendar_table.dt >= (SELECT MIN(tbl_temp_measurement.meas_date) FROM tbl_temp_measurement)
// 				AND calendar_table.dt <=   (SELECT MAX(tbl_temp_measurement.meas_date) FROM tbl_temp_measurement)
//				AND (tbl_temp_measurement.meas_date is NULL or tbl_temp_measurement.rain is NULL)
//				
//				order by dt asc,station_id)";
//		}
//		if($format == 'html') {
//			
//			$sql = "INSERT INTO tbl_missing_measurement(dt,meas_date, station_id,rain )
//
//			(SELECT calendar_table.dt, 
//				tbl_temp_measurement.meas_date,".$station.",
//				tbl_temp_measurement.rain
//				
//				FROM calendar_table LEFT JOIN tbl_temp_measurement on
// 				tbl_temp_measurement.meas_date = calendar_table.dt
// 				WHERE calendar_table.dt <=   (SELECT MAX(tbl_temp_measurement.meas_date) FROM tbl_temp_measurement)
//				AND calendar_table.dt >=  	'". Session::get('FRIST_DATE')[0]."' 
//				AND (tbl_temp_measurement.meas_date is NULL or tbl_temp_measurement.rain is NULL)
//				ORDER BY dt asc,station_id)";
//		}
//		
//		return DB::select(DB::raw($sql));
//		
//	}
	

	/**
	 * Checks directory to see if file already exists, if exists then adds date to file name, else keeps existing name
	 *
	 */	
	public function checkName($file,$type)
	{	
		if(array_search($file, scandir(base_path().DIRECTORY_SEPARATOR . 'upload_files'))) {
			$Name  = substr($file,0,-4).'_'.date('Y-m-d His').$type;
		}else {
			$Name = $file;
		}
		return $Name;
	}
	
	/**
	 * Creates an entry in the batch table for the import, which is appended to the data for the 
	 *
	 */	
	public function createBatch($user_id, $partner_id, $batch_description)
	{	
		$batch_id = DB::table('tabDataBatch')->insertGetId(
		    array('user_id' => $user_id, 'partner_id' => $partner_id, 'batch_description' => $batch_description)
		);		
		return $batch_id;
	}
	
	/**
	 * Creates an entry in the batch table for the import, which is appended to the data for the 
	 *
	 */	
	public function getDistinct($batch_id)
	{	
		//$table_name_parent = DB::table('tabDataParent')->select(array('table_name'))->where('batch_id', '=', $batch_id)->distinct()->get();
		$table_name_parent =DB::table('tabDataParent')->where('batch_id', '=', $batch_id)->distinct()->lists('table_name');	
		$table_name_child = DB::table('tabDataChild')->where('batch_id', '=', $batch_id)->distinct()->lists('table_name');	
		
		$column_name_parent = DB::table('tabDataParent')->where('batch_id', '=', $batch_id)->distinct()->lists('column_name');		
		$column_name_child = DB::table('tabDataChild')->where('batch_id', '=', $batch_id)->distinct()->lists('column_name');
		
		//dd($table_name_child);	
		//dd($column_name_parent);
		
		if($table_name_parent == $table_name_child){
		//OK table_name		
			//dd($column_name_child);		
			if(array_diff($column_name_child, $column_name_parent)){
			  //echo "true";
			  //problem child has columns the parent doesn't
			  $arr_diff = array_diff($column_name_child, $column_name_parent);
			      
			  	$output = NULL;
			  	
			      foreach($arr_diff as $value) {
			         $output .= ' - '.$value.' - ';
			      }	
			      	  
			      		  
				return "FAILED: The child table has columns the parent does not. See column(s): ".$output;
			}else{
				return 'PASSED';
			}
		}
		return 'FAILED: The parent and child table names do not match';
		
		
		
		
		
		
		////$result2 =ImportForm::where('batch_id', '=', $batch_id)->distinct()->get(array('max_temp'));
		
		// array_unique()
		
							
		//Log::info('This is some useful information-'.$result1);
		// LOG.info: This is some useful information.[{"max_temp":"30.5"},{"max_temp":"31.1"},{"max_temp":"31"}]-----[{"max_temp":"30.5"},{"max_temp":"31.1"},{"max_temp":"31"}]		
	}	
	
	
	
	
	
	
	
	public function toDatabase()
	{
		
		$fileName = Session::get('filename');
		File::move(base_path('temp/').$fileName, base_path('upload_files/').$fileName);//Move File Form 'temp' To 'uploadFiles'UploadFiles
		ImportLog::insert(array(
			'filename'   => $fileName,
			'detail'     => 'import by $user',			
		));		
		$source = ImportPreview::get();
		$insert = 0;
		$update = 0;
		foreach ($source as $source)
		{ 
			$target = DB::table('tbl_rain_measurement')
			->where('station_id',$source['station_id'])
			->where('meas_date',$source['meas_date'])
			->where('source',$source['source']);
			if($target->exists())
			{
				$target->update(
						array(
									
								'max_temp' => $source['max_temp'],
								'min_temp' => $source['min_temp'],
								'rain' => $source['rain'],
								'avgrh' => $source['avgrh'],
								'mean_temp' => $source['mean_temp'],
								'meas_year' => $source['meas_year'],
								'max_temp' => $source['max_temp'],
								'meas_month' => $source['meas_month'],
								'meas_day' => $source['meas_day'],
						));
				$update++;
			}
			else
			{
				$target->insert(
						array(
								'station_id'=>$source['station_id'],
								'meas_date'=>$source['meas_date'],
								'source'=>$source['source'],
								'max_temp' => $source['max_temp'],
								'min_temp' => $source['min_temp'],
								'rain' => $source['rain'],
								'avgrh' => $source['avgrh'],
								'mean_temp' => $source['mean_temp'],
								'meas_year' => $source['meas_year'],
								'max_temp' => $source['max_temp'],
								'meas_month' => $source['meas_month'],
								'meas_day' => $source['meas_day'],
						));
				
				$insert++;
		
			}
		
		}
		
		// send message upload success to $this->getIndex()
		Session::put('success',  "<div class='alert alert-success' role='alert'>
				Upload successfully.
				Insert:&nbsp&nbsp".$insert."&nbsp&nbsprow
				Update:&nbsp&nbsp".$update."&nbsp&nbsprow
				</div> ");
		
		return Redirect::to('import');
		
	}
	
	public function Clear()
	{
		Session::forget('success'); //Remove all of the items from the session.
		Session::forget('filename');
		$files = glob(base_path('temp/*')); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file))
				unlink($file); // delete file
		}
	}
	
	public function getTemplate()
	{
		$file= public_path(). "/template.xls";
		$headers = array(
				'Content-Type: application/excel',
		);
		return Response::download($file, 'template.xls', $headers);
	}
	
	public function getExample()
	{
		$file= public_path(). "/example.xls";
		$headers = array(
				'Content-Type: application/excel',
		);
		return Response::download($file, 'example.xls', $headers);
	}


}














