<?php namespace Backoffice\Managers;


class ProfileManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'first_name'	=> 'required|alpha_spaces|min:4',
			'last_name'		=> 'required|alpha_spaces|min:4',
			'password'  	=> 'confirmed',
            'password_confirmation' => '',		
		];

		if($this->scenario == 'user-site') {
			$rules = [
				'about_me'	=> '',
				'image' 	=> 'image|mimes:jpeg,png|max:' . \Config::get('app.image.max-size'),
			];
		}

		return $rules;
	}

	public function prepareData($data)
	{
		if($this->scenario == 'user-site' && isset($data['image'])) {
			$this->uploadFile = true;

			unset($data['image']);
		}

		return $data;
	}

	/**
	 * Implement UploadManagerInterface
	 */
	public function getUploadField()
	{
		return 'image';
	}

	/**
	 * Implement UploadManagerInterface
	 */
	public function getUploadNewName()
	{
		return time() . '.' . $this->data['image']->getClientOriginalExtension();;
	}

	/**
	 * Implement UploadManagerInterface
	 */
	public function getUploadDestination()
	{
		return \Config::get('app.image.avatar-path-server');
	}

}