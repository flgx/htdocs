<?php

use Backoffice\Repositories\BadWordRepository;
use Backoffice\Managers\BadWordManager;

class BadWordsController extends \BaseController {

	private $badWordRepository;

	public function __construct(BadWordRepository $badWordRepository)
	{
		$this->badWordRepository = $badWordRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /badword
	 *
	 * @return Response
	 */
	public function index()
	{
		$config = $this->badWordRepository->findConfig();

		return View::make('backoffice.badword.index', compact('config'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /badword
	 *
	 * @return Response
	 */
	public function update()
	{ 	
		$badWordConfig = $this->badWordRepository->findConfig();
		$manager  	   = new BadWordManager($badWordConfig, Input::all());

		$manager->save();
		
		return Redirect::route('comments.admin')->with('successMessage', 'Las palabras prohibidas se han editado con éxito.');
	}
}