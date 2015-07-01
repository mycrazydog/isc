<?php

class DataStatusController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return DataStatus::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$data = new DataStatus;
		$data->partner_id = Input::get('partner_id');
		$data->year = Input::get('year');
		$data->status = Input::get('status');
		$data->save();
		return Response::make($data, 201);
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		// get the partner id
		$column = 'partner_id'; // This is the name of the column you wish to search
		$data = DataStatus::where($column , '=', $id)->get();
		return $data;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$data = DataStatus::find($id);
		$data->partner_id = Input::get('partner_id');
		$data->year = Input::get('year');
		$data->status = Input::get('status');
		$data->save();
		return Response::make($data, 200);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		// delete
		$data = DataStatus::find($id);
		$data->delete();
		return Response::make('',204);
	}


}
