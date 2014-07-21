<?php

class relativeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /children
	 *
	 * @return Response
	 */
	public function index()
	{
                // get all the children
		$relative = Relationship::all();

		// load the view and pass the children
		return View::make('relatives.index')
			->with('relatives', $relative);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /children/create
	 *
	 * @return Response
	 */
	public function create()
	{
                // load the create form (app/views/children/create.blade.php)
		return View::make('relatives.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /children
	 *
	 * @return Response
	 */
	public function store()
	{
                        $relative = new Relationship;
			$relative->abusedChild_id    = Input::get('abusedChild_id');
			$relative->type              = Input::get('type');
			$relative->custodian         = Input::get('custodian');
                        $relative->sameHouse         = Input::get('sameHouse');
                        $relative->nameCalled        = Input::get('nameCalled');
			$relative->save();

			// redirect
			Session::flash('message', 'Successfully stored Relationship info!');
			return Redirect::to('relatives');
	}

	/**
	 * Display the specified resource.
	 * GET /children/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
                // get the child
		$child = AbusedChild::find($id);

		// show the view and pass the nerd to it
		return View::make('children.show')
			->with('child', $child);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /children/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                // get the child
		$relative = Relationship::find($id);

		// show the view and pass the nerd to it
		return View::make('relatives.edit')
			->with('relative', $relative);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /children/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
                        $relative = Relationship::find($id);
			$relative->abusedChild_id    = Input::get('abusedChild_id');
			$relative->type              = Input::get('type');
			$relative->custodian         = Input::get('custodian');
                        $relative->sameHouse         = Input::get('sameHouse');
                        $relative->nameCalled        = Input::get('nameCalled');
			$relative->save();

			// redirect
			Session::flash('message', 'Successfully updated Relationship info!');
			return Redirect::to('relatives');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /children/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$relative = Relationship::find($id);
		$relative->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the Relationship entry!');
		return Redirect::to('relatives');
	}

}
