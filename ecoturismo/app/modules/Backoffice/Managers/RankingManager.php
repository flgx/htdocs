<?php namespace Backoffice\Managers;


class RankingManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'ranking'   	=> 'required|numeric',
			'location_id'   => 'required|exists:locations,id',		
		];

		return $rules;
	}

	public function prepareData($data)
    {
    	$data['user_id'] = \Auth::user()->id;
    	$data['user_created_id'] = \Auth::user()->id;
        
        return $data;
    }
}