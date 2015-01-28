<?php

//Maatwebsite\Excel\Excel;
//Illuminate\Redis\Database;


class ImportController extends BaseController
{


	protected $importlog;

	public function __construct(ImportLog $importlog)
	{
		$this->importlog = $importlog;
	}



	/**
	* Show a list of all the blog posts.
	*
	* @return View
	*/
	public function getIndex()
	{
		// Grab all the blog posts
		$importlogs = $this->importlog->orderBy('created_at', 'DESC')->paginate(10);

		//Log::info('This is some useful information-');
		// Show the page
		return View::make('backend/import/index', compact('importlogs'));

	}




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
		if (Session::get('success')) {
			$message = Session::get('success');
		}
		// default message for get /import
		else {
			$message ="NA";
		}

		$this->Clear();//Remove all Tempfile and Session

		//populate the partner dropbox
		$partner_options = DB::table('posts')->orderBy('title', 'asc')->lists('title','id');

		// Render Import
		return View::make('backend/import.import')->with('partner_options',$partner_options)->with('message', $message);
	}


	/**
	 * Imports spreadsheet
	 *
	 */
	public function postImport() {

		$partner_options = DB::table('posts')->orderBy('title', 'asc')->lists('title','id');

		// Check input paramiter or file type input
	   $validator = ImportForm::validate(Input::all());

	    if($validator->fails()) {
				//if file display error message
				return View::make('backend/import.import')->withErrors($validator)->with('message',' FAILED ')->with('partner_options',$partner_options);
			}


			///Log::info('This is some useful information-'.$fileNameParent.'--'.$fileNameChild);

		//EXCEL Import
		if ($validator->passes()) {

			// Create a batch and get it's id
			$user_id = Sentry::getUser()->id;
			$partner_id = e(Input::get('partner_id'));
			$batch_description = e(Input::get('batch_description'));
			$batch_id = $this->createBatch($user_id, $partner_id, $batch_description);

			// Handle the file
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if (Input::file('file_parent')){
				$this->importFile($batch_id, 'file_parent', 'tabDataParent', $partner_id, $partner_options);
			}
			if (Input::file('file_child')){
				$this->importFile($batch_id, 'file_child', 'tabDataChild', $partner_id, $partner_options);
			}
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			// Told do imports independently and not do $distinct_check
			//$distinct_check =$this->getDistinct($batch_id);

			//return View::make('backend/import.preview')->with('fileName','<code>'.$fileName.'</code>')->with('batch_id',$batch_id)->with('distinct_check',$distinct_check);

			Log::info('This is some useful information-2');
			return View::make('backend/import.import')->with('batch_id',$batch_id)->with('message', 'Import Successful')->with('partner_options',$partner_options);

		}//end if-validator

	}//end function postImport


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
	* Returns data from import to preview
	*
	*/
	public function deleteBatch($batch_id)
	{
		DB::table('tabDataBatch')->delete($batch_id);
	}

	/**
	* Imports the CSV/Excel file
	*
	*/
	public function importFile($batch_id, $vInput, $vTable, $partner_id, $partner_options)
	{
		Log::info('This is some useful information-'.$batch_id.'--'.$vInput.'--'.$vTable);

		$vFile = Input::file($vInput);
		$vFileName = $this->checkName($vFile->getClientOriginalName(),'xls');
		Session::put('filenameparent',$vFileName);
		Input::file($vInput)->move( base_path('temp'),$vFileName); // import to temp folder

		$results = Excel::selectSheetsByIndex(0)->load(base_path('temp/'.$vFileName), function($reader) {
		})->get()->toArray();//end Excel::load

		$arr = array();

		try {
			if($vInput == 'file_parent'){

				foreach ($results as $value) {
					$temp = array(
						'partner_id'  => $partner_id,
						'table_name'  => trim($value['table_name']),
						'column_name' => Str::slug(trim($value['column_name'])),
						'data_type' 	=> trim($value['data_type']),
						'max_length' 	=> $value['max_length'],
						'complete'    => $value['complete'],
						'total_rows'  => $value['total_rows'],
						'pct_complete'=> $value['pct_complete'],
						'batch_id'		=> $batch_id
					);
					$arr[$value['table_name']][] = $temp;
				}//end foreach
			}else{

				foreach ($results as $value) {
					$temp = array(
						'partner_id'  => $partner_id,
						'table_name'  => trim($value['table_name']),
						'column_name' => Str::slug(trim($value['column_name'])),
						'data_value' 	=> trim($value['data_value']),
						'data_type' 	=> trim($value['data_type']),
						'batch_id'		=> $batch_id
					);
					$arr[$value['table_name']][] = $temp;
				}//end foreach
			}//endif

			try {

				//dd($arr);
				// Insert all data
				foreach ($arr as $station => $value) {
					DB::table($vTable)->insert($value);
				} //end foreach

			}// end inner-try
			catch (Exception $e) {

				// Problem inserting values
				$this->deleteBatch($batch_id);
				return View::make('backend/import.import')->with('message' , 'Problem inserting values - '.$e->getMessage())->with('partner_options',$partner_options);

			}//end inner-catch

		}//end outer-try
		catch (Exception $e){

			// file incorrect
			$this->deleteBatch($batch_id);
			return View::make('backend/import.import')->with('message' , 'Field formatting incorrect - '.$e->getMessage())->with('partner_options',$partner_options);

		}//end outer-catch

	}








	/**
	 * Returns data from import to preview
	 *
	 */
	public function getDatatable()
	{
		$collection = DB::table('tabDataParent')->select("table_name as TBL","column_name as CLM");
		//$collection = DB::table('tabDataParent')->select('table_name as Table Name','column_name as Column Name')->get();

		//return Datatable::from(DB::table('tabDataParent')->select('table_name as Table Name','column_name as Column Name'))
		return Datatable::query($collection)
		        ->showColumns('TBL', 'CLM')
		        ->setSearchWithAlias()
		        ->orderColumns('TBL', 'CLM')
		        ->make();
	}

		/**
		 * Returns data from import to preview
		 *
		 */
		public function getPartnerDatatable($partner_id)
		{

			$data['partner_id'] = $partner_id;
			Log::info('This is some useful information-'.$partner_id);
			$collection = ImportForm::select("table_name as TBL","column_name as CLM", "data_type", "max_length", "complete", "total_rows", "pct_complete", "partner_id")->where('partner_id', '=', $partner_id);

			//return Datatable::from(DB::table('tabDataParent')->select('table_name as Table Name','column_name as Column Name'))
			return Datatable::query($collection)
			    ->showColumns('CLM', 'data_type', 'max_length', 'complete', 'total_rows', 'pct_complete')
					->addColumn('actived',function($model)
					{

					    	//return '<a href="'. URL::to('parkingcompany/update/'.$model->CLM.'/'.$model->partner_id) .'">Details</a>';
					    	return '<a class="open-DetailDialog btn btn-primary" data-toggle="modal" data-target="#DetailModal" data-id="'.$model->partner_id.'" data-column="'.$model->CLM.'" >Details</a>';

					})

			        ->make();
		}

		/**
		 * Returns data from import to preview
		 *
		 */
		public function getPartnerColumnDatatable($partner_id, $column_name)
		{

			$data['partner_id'] = $partner_id;
			$data['column_name'] = $column_name;


			$collection = DB::table('tabDataChild')->select("table_name as TBL","column_name as CLM", "partner_id", "data_value", "data_type")->where('partner_id', '=', $partner_id) ->where('column_name', '=', $column_name);
			////$collection = DB::table('tabDataChild')->select("table_name as TBL","column_name as CLM", "partner_id", "data_value")->where('partner_id', '=', $partner_id) ->where('column_name', '=', $column_name)->get();

			//return Datatable::from(DB::table('tabDataParent')->select('table_name as Table Name','column_name as Column Name'))
			return Datatable::query($collection)
			        ->showColumns('data_value', 'data_type')
			        ->make();

			////return Response::json($collection, 200);


		}


		/**
		 * Returns data from import to preview
		 *
		 */
		public function getStatusesDatatable($status_id)
		{
			/* OLD WAY
			$data['status_id'] = $status_id;
			Log::info('This is some useful information-'.$status_id);
			$collection = DB::table('posts')->select("title", "tags", "slug")->where('status_id', '=', $status_id);

			return Datatable::query($collection)
			        ->showColumns('title', 'tags')
			        ->addColumn('view',function($model)
			        {
			            	return '<a class="open-DetailDialog btn btn-primary" href="'. URL::to('admin/dictionary/'.$model->slug) .'">View codebook</a>';
			        })
			        ->make();
			*/

			/* NEW WAY */



			$collection = DB::table('posts')
			->join('statuses', 'posts.status_id', '=', 'statuses.id')
			->select("posts.title", "posts.tags", "statuses.status", "posts.slug")
			->orderby('statuses.id');


			return Datatable::query($collection)
			->showColumns('title', 'tags', 'status')
			->addColumn('view',function($model)
			{
				return '<a class="open-DetailDialog btn btn-primary" href="'. URL::to('admin/dictionary/'.$model->slug) .'">View codebook</a>';
			})
			->make();


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

		return Redirect::to('admin/import');

	}

	public function Clear()
	{
		Session::forget('success'); //Remove all of the items from the session.
		Session::forget('filenameparent');
		Session::forget('filenamechild');
		$files = glob(base_path('temp/*')); // get all file names


		if($files){
			foreach($files as $file){ // iterate files
				if(is_file($file))
					unlink($file); // delete file
			}
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



	/**
	* Delete confirmation for the given blog post.
	*
	* @param  int      $postId
	* @return View
	*/
	public function getModalDelete($BatchId)
	{
		$model = 'import';

		$confirm_route = $error = null;
		// Check if the blog post exists
		if (is_null($importlog = $this->importlog->find($BatchId))) {

			$error = Lang::get('admin/posts/message.not_found');
			return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
		}

		$confirm_route =  URL::action('delete/import', array('id'=>$importlog->id));
		return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
	}

	/**
	* Delete the given blog post.
	*
	* @param  int      $postId
	* @return Redirect
	*/
	public function getDelete($BatchId)
	{
		// Check if the blog post exists
		if (is_null($importlog = $this->importlog->find($BatchId))) {
			// Redirect to the blogs management page
			return Redirect::to('admin/import')->with('error', Lang::get('admin/posts/message.not_found'));
		}

		// Delete the blog post
		$importlog->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/import')->with('success', Lang::get('admin/import/message.delete.success'));
	}




}
