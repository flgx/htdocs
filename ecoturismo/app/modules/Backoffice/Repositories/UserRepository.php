<?php namespace Backoffice\Repositories;

use Backoffice\Entities\User;
use Backoffice\Entities\Location;

class UserRepository extends BaseRepository
{
	public function getModel()
	{
		return new User;
	}

	public function newUser()
	{
		return new User;
	}
	
	public function find($take, $skip, $sort, $filter)
	{ 
		return User::select('users.id', 'roles.name as role', 'users.first_name', 'users.last_name', 'users.email', 'users.enabled')
						->join('roles', 'users.role_id', '=', 'roles.id')
						->skip($skip)
						->take($take)
						->withoutRoot()	
						->orderBy($sort['field'], $sort['order'])		
						->get();
	}

	public function findById($id)
	{
		return User::find($id);
	}

	public function findByFacebookId($facebookId)
	{
		return User::withoutRoot()
			->where('facebook_id', '=', $facebookId)
			->get()
			->first();
	}

	public function findByEmail($email)
	{
		return User::withoutRoot()
			->where('email', '=', $email)
			->get()
			->first();
	}

	public function count($filter)
	{
		return  User::withoutRoot()->count();
	}

	public function destroy($id)
	{
		if($id != \Config::get('auth.root.user')) {
			User::destroy($id);

			return true;
		} 

		return false;
	}
}