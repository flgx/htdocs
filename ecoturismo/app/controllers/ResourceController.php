<?php

use Backoffice\Repositories\ResourceRepository;
use Backoffice\Managers\ResourceManager;

class ResourceController extends \BaseController {

	private $resourceRepository;

	public function __construct(ResourceRepository $resourceRepository)
	{
		$this->resourceRepository = $resourceRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /resource
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.resource.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /resource/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input 	   = $this->getListRequest();		
		$resources = $this->resourceRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total     = $this->resourceRepository->count($input['filter']);

		return $this->makeListResponse($resources, $total);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backoffice.resource.create');
	}

	/**
	 * Store a new Resource created resource in storage.
	 * POST /resource
	 *
	 * @return Response
	 */
	public function store()
	{  
		$resource = $this->resourceRepository->newResource();
		$manager = new ResourceManager($resource, Input::all());

		$manager->save();
		
		return Redirect::route('resource')->with('successMessage', 'El recurso se ha guardado con éxito.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /resource/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resource = $this->resourceRepository->findById($id);

		if($resource) {
			return View::make('backoffice.resource.edit', ['resource'=>$resource]);
		}

		return Redirect::route('resource')
						 ->with('errorMessage','Imposible editar, no se ha encontrado el recurso especificado');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /resource/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$resource = $this->resourceRepository->findById($id);
		$manager = new ResourceManager($resource, Input::all());

		$manager->save();
		
		return Redirect::route('resource')->with('successMessage', 'El recurso se ha editado con éxito.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /resource/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($this->resourceRepository->destroy($id)) {
			return Redirect::route('resource')->with('successMessage', 'El recurso se ha eliminado con éxito.');
		}

		return Redirect::route('resource')->with('errorMessage', 'El recurso no se ha podido eliminar, por favor verifique que no existan roles con el recurso seleccionado.');
	}
}