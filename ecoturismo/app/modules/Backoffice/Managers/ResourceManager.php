<?php namespace Backoffice\Managers;


class ResourceManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'module'   => 'required|min:4',
			'action'   => 'required|alpha_spaces|min:4',		
		];

		return $rules;
	}

	public function prepareData($data)
    {
    	if(isset($data['module'])) {
        	$data['module'] = strtolower($data['module']);
        }

    	if(isset($data['action'])) {
        	$data['action'] = strtolower($data['action']);
        }
        
        return $data;
    }
}