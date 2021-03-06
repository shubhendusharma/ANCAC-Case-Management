<?php

class AllegedOffenderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /allegedOffender
	 *
	 * @return Response
	 */
	public function index()
	{
                // get all the allegedOffender
		$allegedOffenders = AllegedOffender::where('center_id', Auth::User()->center_id)->get();

		// load the view and pass the allegedOffender
		return View::make('allegedOffenders.index')
			->with('allegedOffenders', $allegedOffenders);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /allegedOffender/create
	 *
	 * @return Response
	 */
	public function create()
	{
                // load the create form (app/views/allegedOffender/create.blade.php)
		return View::make('allegedOffenders.create')->with(array('id'=>0,
                    'case_id'=>0,'county_id'=>0));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /allegedOffender
	 *
	 * @return Response
	 */
	public function store()
	{

                        $allegedOffender = new AllegedOffender;
			//$allegedOffender->person_id = Input::get('person_id');
                        $allegedOffender->case_id = Input::get('case_id');
                        $allegedOffender->county_id = Input::get('county_id');
                        $allegedOffender->center_id         = Auth::User()->center_id;
			



                        if (intval(Input::get('person_id')) == 0){
                            $person = new Person;
                            $person->first = Input::get('first');
                            $person->middle = Input::get('middle');
                            $person->last = Input::get('last');
                            $person->dob = Input::get('dob');
                            $person->gender = Input::get('gender');
                            $person->save();
                            $allegedOffender->person_id = $person->id;
                        }else {
                            $allegedOffender->person_id = Input::get('person_id');
                        }
                        $allegedOffender->save();
                        $relative = new Relationship;
                        $relative->abusedChild_id    = Input::get('abusedChild_id');
			$relative->relationType_id   = Input::get('relationType_id');
			$relative->custodian         = Input::get('custodian',false);
                        $relative->sameHouse         = Input::get('sameHouse',false);
                        $relative->alias             = Input::get('alias');
                        $relative->center_id         = Auth::User()->center_id;
                        $relative->person_id = $person->id;
			$relative->save();
                        
                       //$allegedOffender->relative_id = $relative->id;
                        if ($allegedOffender->sameHouse){
                            $person->household_id = $allegedOffender->child->personalInfo->household_id;
                            $person->save();
                        }
			// redirect
			Session::flash('message', 'Successfully stored alleged offender info!');
			return Redirect::to(Session::get('from'));
	}

	/**
	 * Display the specified resource.
	 * GET /allegedOffender/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
                // get the allegedOffender
		$allegedOffender = AllegedOffender::find($id);

		// show the view and pass the nerd to it
		return View::make('allegedOffenders.show')
			->with('allegedOffender', $allegedOffender);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /allegedOffender/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                // get the allegedOffender
		$allegedOffender = AllegedOffender::find($id);

		// show the view and pass the nerd to it
		return View::make('allegedOffenders.edit')
			->with('allegedOffender', $allegedOffender);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /allegedOffender/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
                        $allegedOffender = AllegedOffender::find($id);
                        $allegedOffender->person_id = Input::get('person_id');
                        $allegedOffender->case_id = Input::get('casse_id');
                        $allegedOffender->county_id = Input::get('county_id');
			$allegedOffender->save();

			// redirect
			Session::flash('message', 'Successfully updated allegedOffender info!');
			return Redirect::to('allegedOffenders');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /allegedOffender/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$allegedOffender = AllegedOffender::find($id);
		$allegedOffender->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the allegedOffender entry!');
		return Redirect::back();
	}

}
