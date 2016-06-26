<?php

use Backoffice\Repositories\RoleRepository;
use Backoffice\Repositories\UserRepository;
use Backoffice\Managers\UserManager;

class UserController extends \BaseController {

	private $roleRepository;
	private $userRepository;

	public function __construct(RoleRepository $roleRepository, UserRepository $userRepository)
	{
		$this->roleRepository 	 = $roleRepository;
		$this->userRepository 	 = $userRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.user.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /user/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input 	  = $this->getListRequest();		
		$users 	  = $this->userRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total    = $this->userRepository->count($input['filter']);

		return $this->makeListResponse($users, $total);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles 	  = $this->roleRepository->findAll();

		return View::make('backoffice.user.create', compact('roles'));
	}

	/**
	 * Store a new User created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{  
		$user = $this->userRepository->newuser();
		$manager = new UserManager($user, Input::all());

		$manager->save();
		
		return Redirect::route('user')->with('successMessage', 'El usuario se ha guardado con éxito.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->userRepository->findById($id);

		if($user) {
			$roles 	  = $this->roleRepository->findAll();

			return View::make('backoffice.user.edit', compact('user', 'roles'));
		}

		return Redirect::route('user')
						 ->with('errorMessage','Imposible editar, no se ha encontrado el usuario especificado');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = $this->userRepository->findById($id);
		$manager = new UserManager($user, Input::all(), 'edit');

		$manager->save();
		
		return Redirect::route('user')->with('successMessage', 'El usuario se ha editado con éxito.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($this->userRepository->destroy($id)) {
			return Redirect::route('user')->with('successMessage', 'El usuario se ha eliminado con éxito.');
		}

		return Redirect::route('user')->with('errorMessage', 'El usuario no se ha podido eliminar.');
	}

}