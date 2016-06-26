<?php

use Backoffice\Repositories\TagRepository;
use Backoffice\Repositories\LocationRepository;
use Backoffice\Repositories\CommentRepository;
use Backoffice\Repositories\UserRepository;
use Backoffice\Repositories\RankingRepository;
use Backoffice\Repositories\BadWordRepository;
use Backoffice\Repositories\ImageRepository;

use Backoffice\Managers\UserManager;
use Backoffice\Managers\LocationManager;
use Backoffice\Managers\RankingManager;
use Backoffice\Managers\CommentManager;
use Backoffice\Managers\ImageManager;

class AppController extends \BaseController {

	protected $tagRepository;
	protected $locationRepository;
	protected $userRepository;
	protected $rankingRepository;
	protected $commentRepository;
	protected $badWordRepository;
	protected $imageRepository;

	public function __construct(TagRepository $tagRepository, LocationRepository $locationRepository, UserRepository $userRepository, RankingRepository $rankingRepository, CommentRepository $commentRepository, BadWordRepository $badWordRepository, ImageRepository $imageRepository)
	{
		$this->tagRepository 	  	= $tagRepository;
		$this->locationRepository 	= $locationRepository;
		$this->userRepository 	  	= $userRepository;
		$this->rankingRepository 	= $rankingRepository;
		$this->commentRepository 	= $commentRepository;
		$this->badWordRepository 	= $badWordRepository;
		$this->imageRepository = $imageRepository;
	}

	/**
	 * Display a listing of the resource.
	 * GET /
	 *
	 * @return Response
	 */
	public function index($token = null)
	{
		$initialLocations   =  [];
		$mainTags       	= $this->tagRepository->findWithoutParent();
		$allLocations		= $this->locationRepository->findAllWithOutImages();
		$allLocationsImg	= $this->locationRepository->findAll();		
		$showModalLogin 	= Input::get('showModalLogin');
		$myRankings			= [];

		if ( ! is_null($token)) {
			Session::flash('token', $token);
			Session::flash('showReset', true);
			Session::flash('showSideBar', true);

			return View::make('app.layouts.master', compact('mainTags', 'allLocations'));
		}	

		if($showModalLogin) {
			Session::reflash();
		}

		$showModalRegister = Input::get('showModalRegister');


		if(Auth::check()) {
			$myRankings = $this->locationRepository->findRankingsByUser(Auth::user()->id);
		}

		return View::make('app.layouts.master', compact('mainTags', 'allLocations','allLocationsImg', 'showModalLogin', 'showModalRegister', 'myRankings'));
	}

	public function getChildrenTags($tagId)
	{
		$mainTag   	= $this->tagRepository->findById($tagId);
		$children  	= $this->tagRepository->findChildren($tagId);		
		$locations 	= $this->locationRepository->findAllByParentTagId($tagId);

		return View::make('app.layouts.tag-list', compact('mainTag', 'children', 'locations'));
	}

	public function getLocationInfo($id)
	{
		$this->locationRepository->addView($id);

		$location = $this->locationRepository->findById($id);
		$location_id = $this->locationRepository->getLocationId($id);
		$the_location_id = $location_id[0]['location_id'];
		$images = $this->locationRepository->getLocationImages($the_location_id);
		
		$comments = $this->commentRepository->findByLocation($id);		
		
		return View::make('app.layouts.location', compact('location', 'comments','images'));
	}

	public function getChildrenLocation($childrenTag)
	{
		$locations = $this->locationRepository->findChildrenLocationById($childrenTag);
		$nameTag   = $this->tagRepository->findName($childrenTag);

		return View::make('app.layouts.children-location', compact('locations', 'nameTag'));
	}
	
	/**
	 * Store a new User created resource in storage.
	 * POST /register
	 *
	 * @return Response
	 */
	public function register()
	{  
		$user = $this->userRepository->newuser();
		$manager = new UserManager($user, Input::all(), 'register');

		$manager->save();

		if (Auth::attempt(Input::only('email', 'password')))
		{
		    return Redirect::route('app.index')->with(['successMessage' => 'Se ha registrado con éxito.', 'showSideBar' => true, 'showProfile' => true ]);
		}

		return Redirect::route('app.index')->with(['successMessage' => 'Se ha registrado con éxito.']);
	}

	public function login()
    {
        $data = Input::only('email', 'password', 'remember');

        $credentials = ['email' => $data['email'], 'password' => $data['password'], 'enabled' => 1];

        if (Auth::attempt($credentials, $data['remember']))
        {
            return Redirect::route('app.index')->with(['successMessage' => 'Bienvenido ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . '!', 'showSideBar' => true, 'showProfile' => true ]);
        }

        return Redirect::route('app.index')->with(['errorMessage' => 'Datos no válidos.', 'showSideBar' => true, 'showLogin' => true]);
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('app.index');
    }
	

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{   
		Config::set('auth.reminder.email', 'app.password.reminder');

		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with(['error' => Lang::get($response), 'showRemind' => true, 'showSideBar' => true]);

			case Password::REMINDER_SENT:
				return Redirect::back()->with(['status' => Lang::get($response), 'showRemind' => true, 'showSideBar' => true]);
		}
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = $password;

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/')->with(['showLogin' => true, 'showSideBar' => true, 'successMessage' => 'Su Contraseña se ha resetado con éxito.' ]);
		}
	}

	public function ranking()
	{
		$ranking = $this->rankingRepository->getModel();
		$manager = new RankingManager($ranking, Input::all());

		$manager->save();

		$location = $this->locationRepository->findById(input::get('location_id'));
		$manager  = new LocationManager($location, Input::all(), 'ranking');

		$manager->save();

		return Response::json(['success'=> true]);
	}

	public function comment()
	{
		if($this->badWordRepository->exists(Input::get('comment', ''))) {
			return Response::json(['success'=> null]);
		}

		$comment = $this->commentRepository->getModel();
		$manager = new CommentManager($comment, Input::all());

		$manager->save();

		return Response::json(['success'=> true]);
	}
}