<?php namespace Backoffice\Managers;


class TagManager extends BaseManager
{
	public function getRules()
	{
		$rules = [];

		if($this->scenario == 'locations') {
			$rules = [
				'locations_quantity' => 'integer',
			];
		}

		if($this->scenario == 'edit') {
			$rules = [
				'name' 			=> 'required|alpha_spaces|min:4',
				'parent_tag_id' => '',
				'icon' 			=> '',
				'marker' 		=> '',
				'user_created_id' =>'',
			];
		}

		return $rules;
	}

	public function prepareData($data)
    {   
    	if(isset($data['parent_tag_id']) && $data['parent_tag_id'] == 0) {
    		unset($data['parent_tag_id']);
    	}

        return $data;
    }
}