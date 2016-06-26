<?php namespace Backoffice\Managers;

use Backoffice\Entities\Resource;
use Backoffice\Repositories\RoleRepository;

class RoleManager extends BaseManager
{
	protected $roleRepository;

	public function initialize()
	{
		$this->roleRepository = new RoleRepository;
	}

	public function getRules()
	{
		$rules = [
			'name' 		=> 'required|alpha_spaces|min:4|max:50|unique:roles,name,'.$this->entity->id.',id,deleted_at,NULL',	
			'resources' => 'array'	
		];

		return $rules;
	}

    public function prepareData($data)
    {
    	if(isset($data['name'])) {
        	$data['name'] = strtoupper($data['name']);
        }
        
        return $data;
    }

    public function save()
    {
    	$success = parent::save();

    	if(isset($this->data['resources'])){
    		$this->roleRepository->resourceDestroy($this->entity->id);
    		$this->roleRepository->resourcesAttach($this->entity->id, $this->data['resources']);
	    }
    }
    
}