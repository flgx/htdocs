<?php

use Backoffice\Repositories\UserRepository;
use Backoffice\Managers\ProfileManager;

class ProfileController extends \BaseController {

	private $profileRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /profile
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			$profile = $this->userRepository->findById(Auth::user()->id);

			if($profile) {
				return View::make('backoffice.profile.edit', compact('profile'));
			}
		}

		return Redirect::route('login.show')
						 ->with('errorMessage','Imposible editar su perfil, no se ha encontrado');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /profile
	 *
	 * @return Response
	 */
	public function update()
	{
		$profile = $this->userRepository->findById(Auth::user()->id);
		$manager = new ProfileManager($profile, Input::all());

		$manager->save();
		
		return Redirect::route('profile')->with('successMessage', 'Su perfil se ha editado con éxito.');
	}

	/**
	 * Update the specified resource in storage.
	 * POST /profile
	 *
	 * @return Response
	 */
	public function editUser()
	{
		$profile = $this->userRepository->findById(Auth::user()->id);
		$manager = new ProfileManager($profile, Input::all(), 'user-site');

		$manager->save();

		return Redirect::route('app.index')->with(['successMessage' => 'Su perfil se ha editado con éxito.', 'showProfile' => true]);
	}

}