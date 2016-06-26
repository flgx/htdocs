<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Role;
use Backoffice\Entities\User;

class RoleRepository extends BaseRepository
{
	public function getModel()
	{
		return new Role;
	}

	public function newRole()
	{
		return new Role;
	}
	
	public function find($take, $skip, $sort, $filter)
	{ 
		return Role::select('id','name')
						->skip($skip)
						->take($take)	
						->withoutRoot()
						->orderBy($sort['field'], $sort['order'])			
						->get();
	}
	
	public function findAll()
	{ 
		return Role::select('id','name')->withoutRoot()->get();
	}

	public function findById($id)
	{
		return Role::find($id);
	}

	public function count($filter)
	{
		return  Role::withoutRoot()->count();
	}

	public function destroy($id)
	{
		$users = User::select('id')->where('role_id', '=', $id)->take(1)->get()->toArray();

		if( ! $users) {
			Role::destroy($id);
			
			return true;
		}

		return false;
	}

	public function findAvailableResources($id)
	{
		return \DB::table('roles_resources')
					->select('roles_resources.resource_id')
	            	->where('roles_resources.role_id', '=', $id)
	            	->get();
	}

	public function resourceDestroy($id)
	{
		\DB::table('roles_resources')->where('role_id', '=', $id)->delete();
	}

	public function resourcesAttach($id, $resources)
	{
		$role = Role::find($id);

		$role->resources()->sync($resources);
	}
}