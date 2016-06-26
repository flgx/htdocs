<?php

use Backoffice\Repositories\LocationRepository;
use Backoffice\Repositories\TagRepository;
use Backoffice\Repositories\ImageRepository;
use Backoffice\Managers\LocationManager;

class LocationController extends \BaseController {

	private $locationRepository;
	private $tagRepository;
	private $imageRepository;

	public function __construct(LocationRepository $locationRepository, TagRepository $tagRepository, ImageRepository $imageRepository)
	{
		$this->locationRepository = $locationRepository;
		$this->tagRepository 	  = $tagRepository;
		$this->imageRepository = $imageRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /location
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.location.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /location/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input 	  	= $this->getListRequest();		
		$locations 	= $this->locationRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total    	= $this->locationRepository->count($input['filter']);

		return $this->makeListResponse($locations, $total);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /location/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = $this->tagRepository->findAllChildByCombo();

		return View::make('backoffice.location.create', compact('tags'));
	}

	/**
	 * Store a new User created resource in storage.
	 * POST /location
	 *
	 * @return Response
	 */
	public function store()
	{  
		$mytime = Carbon\Carbon::now();
		$id =$mytime->timestamp;
		$location 	= $this->locationRepository->getModel();
		$location->location_id = $id;
		$url =  Input::get('url');
		if(isset($url)){
			$location->url = $url;
		}
		
		$manager = new LocationManager($location,Input::all());
		
		$count = 0;
		foreach(Input::file('image') as $file){
			$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator = Validator::make(array('file'=> $file), $rules);
			if($validator->passes()){
				$timer = Carbon\Carbon::now();
				$location_images = $this->imageRepository->getModel();
				$destinationPath = \Config::get('app.image.location-path-server');
				$filename = rand() . '.' . $file->getClientOriginalExtension();
				$upload_success = $file->move($destinationPath, $filename);
				$location_images->location_id = $id;
				$location_images->image_id = $filename;
				$location_images->save();

			}			 
		}

		$manager->save();
		
		return Redirect::route('location')->with('successMessage', 'El punto interactivo se ha guardado con éxito.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /location/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$location = $this->locationRepository->findById($id);
 		$location_id = $this->locationRepository->getLocationId($id);
		$the_location_id = $location_id[0]['location_id'];
		$url =  Input::get('url');
	    if(isset($url)){
			$location->url = $url;
		}			
		$images = $this->locationRepository->getLocationImages($the_location_id);
		if($location) {

			$location['tags'] = $this->locationRepository->findTagsByLocationId($id);
			$tags 			  = $this->tagRepository->findAllChildByCombo();
			
			return View::make('backoffice.location.edit', compact('location', 'tags', 'images'));
		}

		return Redirect::route('location')
						 ->with('errorMessage','Imposible editar, no se ha encontrado el punto interactivo especificada');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /location/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{ 	


		$location = $this->locationRepository->findById($id);
		$the_location_id = $location['location_id'];
		$images = $this->locationRepository->getLocationImages($the_location_id);
		$url = $location['url'];
		$location->location_id = $the_location_id;
		    if(isset($url)){
			$location->url = $url;
		}	

		$manager = new LocationManager($location,Input::all());
		
		$count = 0;
		foreach(Input::file('image') as $file){
			$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator = Validator::make(array('file'=> $file), $rules);
			if($validator->passes()){
				$timer = Carbon\Carbon::now();
				$location_images = $this->imageRepository->getModel();
				$destinationPath = \Config::get('app.image.location-path-server');
				$filename = rand() . '.' . $file->getClientOriginalExtension();
				
				$upload_success = $file->move($destinationPath, $filename);
				$location_images->location_id = $the_location_id;
				$location_images->image_id = $filename;
				$location_images->save();

			}			 
		}
		$manager->save();
	

		
		return Redirect::route('location')->with('successMessage', 'El punto interactivo se ha editado con éxito.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /location/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($this->locationRepository->destroy($id)) {
			return Redirect::route('location')->with('successMessage', 'El punto interactivo se ha eliminado con éxito.');
		}

		return Redirect::route('location')->with('errorMessage', 'El punto interactivo no se ha podido eliminar.');
	}
	public function destroyImage($id)
	{	
		$location_id = $this->locationRepository->getLocationIdFromUpdate($id);
		$location_original_id = $this->locationRepository->getLocationOriginalId($location_id);
		
		$this->locationRepository->deleteOneImage($id);
			return Redirect::back()->with('successMessage', 'La imagen se elimino con éxito.');
		

		return Redirect::route('location')->with('errorMessage', 'La imagen no se ha podido eliminar.');
	}

}