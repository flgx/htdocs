<?php


use Backoffice\Repositories\LocationRepository;

class DashboardController extends \BaseController {

	const CANT_RANKED = 10;
	const CANT_VIEWS  = 10;

	protected $locationRepository;

	public function __construct(LocationRepository $locationRepository)
	{
		$this->locationRepository = $locationRepository;
	}


	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
		$pointsRanked = $this->locationRepository->findBestRanked(self::CANT_RANKED);
		$pointsViews  = $this->locationRepository->findBestViews(self::CANT_VIEWS);

		return View::make('backoffice.dashboard.index', compact('pointsRanked', 'pointsViews'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dashboard/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboard
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dashboard/{id}/edit
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
	 * PUT /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}