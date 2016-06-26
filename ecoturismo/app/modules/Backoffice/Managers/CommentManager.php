<?php namespace Backoffice\Managers;


class CommentManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'comment'   	=> 'required',
			'location_id'   => 'required|exists:locations,id',		
		];

		if($this->scenario == 'block' || $this->scenario == 'unblock') {
			$rules = [];
		}

		return $rules;
	}

	public function prepareData($data)
    {
    	if($this->scenario == 'block') {
    		$data['block'] = 1;

    		return $data;
    	}

    	if($this->scenario == 'unblock') {
    		$data['block'] = 0;

    		return $data;
    	}
    	
    	$data['user_id'] = \Auth::user()->id;
    	$data['user_created_id'] = \Auth::user()->id;
        
        return $data;
    }


}