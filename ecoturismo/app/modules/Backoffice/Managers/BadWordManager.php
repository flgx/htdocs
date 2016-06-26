<?php namespace Backoffice\Managers;


class BadWordManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'words' => '',	
		];

		return $rules;
	}


    public function prepareData($data)
    {
    	$data['words'] = preg_replace("/\r\n+|\r+|\n+|\t+/i", " ", $data['words']);
        $data['words'] = strtolower($data['words']);
        $words 		   = explode(",", $data['words']);

        foreach($words as $index => $value)
        {
        	$words[$index] = trim($value);
        }

        $data['words'] = implode(",", $words);

        return $data;
    }
}