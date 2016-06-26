<?php namespace Backoffice\Managers;

use Backoffice\Repositories\LocationRepository;
use Backoffice\Repositories\RankingRepository;

class LocationManager extends BaseManager
{
    protected $locationRepository;
	protected $rankingRepository;

	public function initialize()
	{
        $this->locationRepository = new LocationRepository;
		$this->rankingRepository  = new RankingRepository;
	}

	public function getRules()
	{
		$rules = [
			'name' 			=> 'required|alpha_num_spaces|min:4',
			'description' 	=> 'required',	
			'lat' 			=> 'required|numeric',
			'lng' 			=> 'required|numeric',
			'enabled'       => 'in:1,0',
			'tags'			=> ''
		];

        if($this->scenario == 'ranking') {
            $rules = [ 
                'location_id' => 'required',
            ];
        }

		return $rules;
	}

	public function prepareData($data)
    {   
        if($this->scenario == 'ranking') {
            $data['ranking'] = $this->rankingRepository->calculateRanking($this->data['location_id']);

            return $data;
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

	/**
	 * Implement UploadManagerInterface
	 */
    public function getUploadField()
    {
    	return 'image';
    }


    public function getUploadNewName()
    {
    	return time() . '.' . $this->data['image']->getClientOriginalExtension();
    }

	/**
	 * Implement UploadManagerInterface
	 */
    public function getUploadDestination()
    {  
    	return \Config::get('app.image.location-path-server');
    }

}