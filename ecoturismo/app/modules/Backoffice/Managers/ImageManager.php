<?php namespace Backoffice\Managers;
use Backoffice\Repositories\ImageRepository;

class ImageManager extends BaseManager 
{
	protected $imageRepository;
	public function initialize()
	{
        $this->imageRepository = new ImageRepository;
	}

	public function getRules()
	{
		$rules = [
			'location_id' 			=> 'required|alpha_num_spaces|min:4',
			'image_id' 	=> 'required',
		];

		return $rules;
	}
	public function prepareData($data)
    { 

    	if(isset($data['image'])) {
    		$this->uploadFile = true;

    		unset($data['image']);
    	}

        if ( ! isset ($data['enabled']))
        {
            $data['enabled'] = 0;
        }


        return $data;
    }
        public function save()
    {
    	$success = parent::save();

    	if(isset($this->data['tags'])) {
    		$this->locationRepository->tagsDestroy($this->entity->id);
    		$this->locationRepository->tagsAttach($this->entity->id, $this->data['tags']);
    	}
    }

}


?>