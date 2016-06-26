<?php namespace Backoffice\Managers;


class UserManager extends BaseManager
{
	const USER_ROLE = 3;

	public function getRules()
	{
		$rules = [
			'first_name'	=> 'required|alpha_spaces|min:4',
			'last_name'		=> 'required|alpha_spaces|min:4',
			'email'   		=> 'required|email|unique:users,email,'. $this->entity->id,
			'role_id'    	=> 'required|exists:roles,id',
			'password'  	=> 'required|confirmed',
            'password_confirmation' => 'required',
			'enabled'       => 'in:1,0',		
		];

		if( ! \BackofficeResource::isRoot()) {
			$rules['role_id']    = 'not_in:1';
		}

		if($this->scenario == 'edit') {
			$rules['password'] 				= 'confirmed';
			$rules['password_confirmation'] = '';
		}

		if($this->scenario == 'register') {
			$rules['role_id'] = '';
		}

		return $rules;
	}

	public function prepareData($data)
    {   
        if ( ! isset ($data['enabled']))
        {
            $data['enabled'] = 0;
        }

        if($this->scenario == 'register') {
        	$data['role_id']         = self::USER_ROLE;
        	$data['user_created_id'] = \Config::get('auth.root.user');
        	$data['enabled'] = 1;
        }

        return $data;
    }
}