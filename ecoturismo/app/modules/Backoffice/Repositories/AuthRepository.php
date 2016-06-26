<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Auth;
use Backoffice\Entities\Location;

class AuthRepository extends BaseRepository
{
    public function getModel()
    {
        return new Auth;
    }

    public function newUser()
    {
        return new Auth;
    }


    public function findByFacebookId($facebookId)
    {
        return Auth::where('facebook_id', '=', $facebookId)
            ->get()
            ->first();
    }

    public function findByEmail($email)
    {
        return Auth::where('email', '=', $email)
            ->get()
            ->first();
    }
}