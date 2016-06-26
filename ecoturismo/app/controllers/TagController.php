<?php

use Backoffice\Repositories\TagRepository;
use Backoffice\Managers\TagManager;

class TagController extends \BaseController {

	private $tagRepository;

	public function __construct(TagRepository $tagRepository)
	{
		$this->tagRepository = $tagRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /tag
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.tag.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /tag/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input 	  = $this->getListRequest();		
		$tags 	  = $this->tagRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total    = $this->tagRepository->count($input['filter']);

		return $this->makeListResponse($tags, $total);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tag/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$parentTags = $this->tagRepository->findAllWithout();
		$markers 	= $this->tagRepository->findMarkers();
		$icons 		= $this->tagRepository->findIcons();
		$user_created_id    = \Auth::id();

		return View::make('backoffice.tag.create', compact('parentTags', 'markers', 'icons','user_created_id'));
	}

	/**
	 * Store a new User created resource in storage.
	 * POST /tag
	 *
	 * @return Response
	 */
	public function store()
	{  
		$tag 	 = $this->tagRepository->getModel();
		$manager = new TagManager($tag, Input::all(), 'edit');
		/*
		echo '<pre>';
		var_dump($manager);
		echo '</pre>';
		exit();*/
		$manager->save();
		
		return Redirect::route('tag')->with('successMessage', 'La etiqueta se ha guardado con éxito.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tag/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tag = $this->tagRepository->findById($id);

		if($tag) {
			$parentTags = $this->tagRepository->findAllWithout($id);
			$markers 	= $this->tagRepository->findMarkers();
			$icons 		= $this->tagRepository->findIcons();
			$user_created_id    = \Auth::id();

		

			return View::make('backoffice.tag.edit', compact('tag', 'parentTags', 'markers', 'icons','user_created_id'));
		}

		return Redirect::route('tag')
						 ->with('errorMessage','Imposible editar, no se ha encontrado la etiqueta especificada');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$tag 	 = $this->tagRepository->findById($id);
		$manager = new TagManager($tag, Input::all(), 'edit');

		$manager->save();
		
		return Redirect::route('tag')->with('successMessage', 'La etiqueta se ha editado con éxito.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($this->tagRepository->destroy($id)) {
			return Redirect::route('tag')->with('successMessage', 'La etiqueta se ha eliminado con éxito.');
		}

		return Redirect::route('tag')->with('errorMessage', 'La etiqueta no se ha podido eliminar, la misma tiene información relacionada.');
	}

}