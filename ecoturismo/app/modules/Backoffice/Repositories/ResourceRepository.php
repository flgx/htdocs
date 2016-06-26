<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Resource;

class ResourceRepository extends BaseRepository
{
	public function getModel()
	{
		return new Resource;
	}

	public function newResource()
	{
		return new Resource;
	}
	
	public function find($take, $skip, $sort, $filter)
	{ 
		return Resource::select('id','module', 'action')
						->skip($skip)
						->take($take)	
						->orderBy($sort['field'], $sort['order'])			
						->get();
	}

	public function findAll()
	{ 
		return Resource::select('id', 'module', 'action')
						 ->orderBy('module', 'ASC')
						 ->get();
	}

	public function findById($id)
	{
		return Resource::find($id);
	}

	public function count($filter)
	{
		return  Resource::count();
	}

	public function destroy($id)
	{
		$allocated = \DB::table('roles_resources')->where('resource_id', '=', $id)->take(1)->get();

		if( ! $allocated) {
			Resource::destroy($id);
			
			return true;
		}

		return false;
	}

	public function findByRole($id)
	{
		return \DB::table('roles_resources')
					->select('resources.module', 'resources.action')
					->join('resources', 'roles_resources.resource_id', '=', 'resources.id')
	            	->where('roles_resources.role_id', '=', $id)
	            	->get();
	}
}