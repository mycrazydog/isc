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
					
			$results = Excel::load(base_path('temp/'.$fileName), function($reader) {
			})->get()->toArray();//end Excel::load
			
			
				/////////////////
				$arr = array();
			
				try {
		
					foreach ($results as $value) {
						if(isset($value['year']) && isset($value['month']) && isset($value['dday'])  ) {						
						 						 	
						 	$temp = array(						 	
						 			'meas_date'   => $value['year'].'-'.$value['month'].'-'.$value['dday'],
						 			'station_id'  => $value['stncode'],
						 			'max_temp' 	  => $value['maxtmp'],
						 			'min_temp' 	  => $value['mintmp'],
						 			'rain' 		  => $value['rain'],
						 			'avgrh' 	  => $value['avgrh'],
						 			'evapor'      => $value['evapor'],
						 			'mean_temp'	  => $value['meantemp'],
						 			'source'	  => 1,
						 			'meas_year'   => $value['year'],
						 			'meas_month'  => $value['month'],
						 			'meas_day'    => $value['dday'],
						 			'batch_id'		=> $batch_id
						 	);
						 						 				 	
						 	$arr[$value['stncode']][] = $temp;
						 	
					 	}//end if			
					}//end foreach					
					 	
					 	try {			 					 	
					 		//insert all data
					 		foreach ($arr as $station => $value) {					 			
					 			DB::table('tbl_temp_measurement')->insert($value); 			
					 		} //end foreach			 		
					 		
					 	}// end inner-try 
					 	catch (Exception $e) {	 			 	
						 	// Problem inserting values
						 	return Redirect::to('import')->with('message' , 'problem inserting values');	
					 	}//end inner-catch
					 						 	
				}//end outer-try
				catch (Exception $e){
					// file incorrect
					return Redirect::to('import')->with('message' , 'file incorrect	');				
				}//end outer-catch	
			
			$this->getDistinct($batch_id);
			return View::make('backend/import.preview')->with('fileName','<code>'.$fileName.'</code>')->with('batch_id',$batch_id);			
		
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
		$result1 =ImportForm::select(array('max_temp'))->where('batch_id', '=', $batch_id)->distinct()->get();
		$result2 =ImportForm::where('batch_id', '=', $batch_id)->distinct()->get(array('max_temp'));
					
		Log::info('This is some useful information.'.$result1.'-----'.$result2);		
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














