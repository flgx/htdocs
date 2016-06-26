<?php

use Backoffice\Managers\ReportManager;

class ReportController extends \BaseController {

	/**
	 * Display a report dashboard.
	 * GET /report
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.report.index');
	}

	public function generate()
	{	
		$reportManager 	= new ReportManager(Input::all());
		$report 		= $reportManager->generate();
		$dateTime 		= new DateTime('NOw');

		return CSV::fromArray($report)->setHeaderRowExists(false)->render('Reporte_' . Input::get('report', '') .'_' . $dateTime->getTimestamp() .'.csv' ); 
	}
}