<?php

use Backoffice\Repositories\AuthRepository;

class AuthController extends \BaseController {

    protected $userRepository;

    public function __construct(AuthRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        $data = Input::only('email', 'password', 'remember');

        $credentials = ['email' => $data['email'], 'password' => $data['password'], 'enabled' => DB::raw('1  AND `role_id` in (1, 2)')];

        if (Auth::attempt($credentials, $data['remember']))
        {
            return Redirect::route('dashboard');
        }

        return Redirect::back()->with('login_error', 1);
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('login.show');
    }

    public function show()
    {
    	return View::make('backoffice.auth.login');
    }

    /**
     * Login user with facebook
     *
     * @return void
     */

    public function loginWithFacebook() {

        // get data from input
        $code = Input::get( 'code' );

        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid
        //$user = $this->userRepository->findByFacebookId($code);

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me?fields=id,first_name,last_name,name,email' ), true );

            $user = $this->userRepository->findByFacebookId($result['id']);
	
            if(!$user) {
                $user = $this->userRepository->findByEmail($result['email']);

                if($user) {
                    $user->facebook_id = $result['id'];
                    $user->save();
                } else {
                    $user = $this->userRepository->newUser();

                    $user->first_name = $result['first_name'];
                    $user->last_name = $result['last_name'];
                    $user->email = $result['email'];
                    $user->facebook_id = $result['id'];
                    $user->role_id = 3;
                    $user->enabled = 1;
                    $user->user_created_id = 1;

                    $user->save();
                }
            }

            Auth::login($user, true);

            return Redirect::route('app.index')->with(['successMessage' => 'Bienvenido ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . '!', 'showSideBar' => true, 'showProfile' => true ]);
        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }

    }

} 