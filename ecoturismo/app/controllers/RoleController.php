<?php

use Backoffice\Repositories\RoleRepository;
use Backoffice\Repositories\ResourceRepository;
use Backoffice\Managers\RoleManager;

class RoleController extends \BaseController {

	private $roleRepository;
	private $resourceRepository;

	public function __construct(RoleRepository $roleRepository, ResourceRepository $resourceRepository)
	{
		$this->roleRepository 		= $roleRepository;
		$this->resourceRepository 	= $resourceRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /role
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.role.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /role/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input = $this->getListRequest();		
		$roles = $this->roleRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total = $this->roleRepository->count($input['filter']);

		return $this->makeListResponse($roles, $total);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /role/create
	 *
	 * @return Response
	 */
	public function create()
	{  
		return View::make('backoffice.role.create');
	}

	/**
	 * Store a new Role created resource in storage.
	 * POST /role
	 *
	 * @return Response
	 */
	public function store()
	{  
		$role 		= $this->roleRepository->newrole();
		$manager 	= new RoleManager($role, Input::all());

		$manager->save();
		
		return Redirect::route('role')->with('successMessage', 'El role se ha guardado con éxito.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /role/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{  
		$role = $this->roleRepository->findById($id);

		if($role) {
			return View::make('backoffice.role.edit', compact('role'));
		}

		return Redirect::route('role')->with('errorMessage','Imposible editar, no se ha encontrado el role especificado');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role 		= $this->roleRepository->findById($id);
		$manager 	= new RoleManager($role, Input::all());

		$manager->save();
		
		return Redirect::route('role')->with('successMessage', 'El role se ha editado con éxito.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($this->roleRepository->destroy($id)) {
			return Redirect::route('role')->with('successMessage', 'El role se ha eliminado con éxito.');
		}

		return Redirect::route('role')->with('errorMessage', 'El role no se ha podido eliminar, por favor verifique que no existan usuarios con el role seleccionado.');
	}

	 /**
	 * Display a listing of the resource with available check.
	 * GET /role/{id}/resources
	 *
	 * @return Response
	 */
	public function toCheck($id)
	{		
		$resources  = $this->resourceRepository->findAll()->toArray();
		$availables = $this->roleRepository->findAvailableResources($id);

		return View::make('backoffice.role.resources', compact('resources', 'availables'));
	}

}