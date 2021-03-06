

<?php

class CaseController extends \BaseController {
    
/* created by Bagget, Egui, and Murphy summer 2014 */
/* the controller for the cases. include CRUD functions*/
/* for cases as well as functions to index, show and store the case */
/* also includes functions to add and remove workers and abuse types */
	/**
	 * Display a listing of the resource.
	 * GET /casecontrller
	 *
	 * @return Response
	 */
	public function index()
	{
            $openCases = null;
            $allCases = TrackedCase::where('center_id', Auth::User()->center_id)->get();
            $filteredCases = null;
            $case = null;
            $frmDate = Input::get('frmDate');
            $toDate = Input::get('toDate');

            
            
		if(Input::get('selOpnCases')== true)
                {
                    
                    
                   
                    
                    foreach($allCases as $rec)
                    {
                        if($rec->status == 'open')
                        {
                           $openCases[]=$rec;
                        }
                    }
          
                    
                   $filteredCases = $openCases; 
                }
                else 
                {
                    $filteredCases = $allCases;

                }
                if(strlen($frmDate) > 2 && strlen($toDate) > 2)
                {
                    
                    foreach($filteredCases as $rec)
                    {
                        if($rec->caseOpened > $frmDate && $rec->caseOpened < $toDate)
                        {
                            $case[]=$rec;
                        }
                    }
                 }
                 else
                 {
                     $case= $filteredCases;
                 }
                
                
                

		// load the view and pass the casecntroller
		return View::make('cases.index')
			->with('case', $case);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /casecontrller/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('cases.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /casecontrller
	 *
	 * @return Response
	 */
	public function store()
	{
		$household = new Household;
                $household->save();
                
                $person = new Person;
		$person->first = Input::get('childFirst',"");
                $person->middle = Input::get('childMiddle',"");
		$person->last = Input::get('childLast',"");
                $person->age = Input::get('childAge',"");
                $person->gender = Input::get('gender');
                $person->household_id = $household->id;
                $person->save();
            
                $child = new AbusedChild;
                $child->person_id        = $person->id;
                $child->save();
                        
                $case = new TrackedCase;
                $case->caseNumber           = input::get('caseNumber');
                $case->abusedChild_id       = $child->id;
                $case->worker_id            = Input::get('worker_id');
		$case->note                 = Input::get('note');
		$case->caseOpened           = Input::get('caseOpened',date('Y-m-d'));
		$case->county_id            = Input::get('county_id');
		$case->custodyIssues        = Input::get('custodyIssues', false);
		$case->IOReport             = Input::get('IOReport',false);
		$case->domesticViolence     = Input::get('domesticViolence',false);
		$case->prosecution          = Input::get('prosecution',false);
		$case->reporter             = Input::get('reporter');
		$case->abuseDate            = Input::get('abuseDate');
		$case->abuseLocation        = Input::get('abuseLocation');
		$case->referralReason        = Input::get('referralReason');
		$case->DHRDetermination     = Input::get('DHRDetermination');
		$case->forensicEvaluation   = Input::get('forensicEvaluation',false);
		$case->status               = Input::get('status',"open");
		$case->chargesFiled         = Input::get('chargesFiled');
		$case->agencyReportedTo     = Input::get('agencyReportedTo');
		$case->talkedToChild        = Input::get('talkedToChild');
		$case->reportedDate         = Input::get('reportedDate');
                $case->center_id         = Auth::User()->center_id;
		$case->save();

		// redirect
		Session::flash('message', 'Successfully created case!');
		return Redirect::to('cases');
	}

	/**
	 * Display the specified resource.
	 * GET /casecontrller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
						// get the case
		$case = TrackedCase::find($id);
		//$kid = AbusedChild::find($case->abusedChild_id);
		//$kidInfo = Person::find($kid->person_id);

		// show the view and pass the abuseType to it
		return View::make('cases.show', array('case'=>$case));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /casecontrller/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$case = TrackedCase::find($id);

		// show the edit form and pass the casecontroller
		return View::make('cases.edit')
			->with('case', $case);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /casecontrller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$case = TrackedCase::find($id);
                $case->worker_id            = Input::get('worker_id');
		$case->note                 = Input::get('note');
		$case->county_id            = Input::get('county_id');
		$case->custodyIssues        = Input::get('custodyIssues', false);
		$case->IOReport             = Input::get('IOReport',false);
		$case->domesticViolence     = Input::get('domesticViolence',false);
		$case->prosecution          = Input::get('prosecution',false);
		$case->reporter             = Input::get('reporter');
		$case->abuseDate            = Input::get('abuseDate');
		$case->abuseLocation        = Input::get('abuseLocation');
		$case->referralReason        = Input::get('referralReason');
		$case->DHRDetermination     = Input::get('DHRDetermination');
		$case->forensicEvaluation   = Input::get('forensicEvaluation',false);
		$case->status               = Input::get('status',"open");
		$case->chargesFiled         = Input::get('chargesFiled');
		$case->agencyReportedTo     = Input::get('agencyReportedTo');
		$case->talkedToChild        = Input::get('talkedToChild');
		$case->reportedDate         = Input::get('reportedDate');
		$case->save();

		// redirect
		Session::flash('message', 'Successfully updated case info!');
		return Redirect::to('cases');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /casecontrller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$case = TrackedCase::find($id);
		$case->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the case entry!');
		return Redirect::to('cases');
	}
        
        public function addWorker($id) {
            $worker = Input::get('worker_id');
            DB::table('case_worker')->insert(array('case_id' => $id, 'worker_id' => $worker));
            Session::flash('message', 'Successfully added worker!');
            return Redirect::to('cases/'.$id);
        }
        
        public function removeWorker($id) {
            $worker = Input::get('worker_id');
            DB::table('case_worker')->where('case_id', $id)->where('worker_id', $worker)->delete();
            Session::flash('message', 'Successfully removed worker!');
            return Redirect::to('cases/'.$id);
        }
        
        public function addAbuseType($id) {
            $abuses = Input::get('abuseType_id');
            DB::table('abuses')->insert(array('case_id' => $id, 'abuseType_id' => $abuses));
            Session::flash('message', 'Successfully added abuse Type!');
            return Redirect::to('cases/'.$id);
        }
     
        public function removeAbuseType($id) {
             $abuses = Input::get('abuseType_id');
            DB::table('abuses')->where('case_id', $id)->where('abuseType_id', $abuses)->delete();
            Session::flash('message', 'Successfully removed Abuse Type!');
            return Redirect::to('cases/'.$id);
        }
}
