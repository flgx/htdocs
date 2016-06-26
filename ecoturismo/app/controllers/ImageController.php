<?php

use Backoffice\Repositories\LocationRepository;
use Backoffice\Repositories\ImageRepository;

class ImageController extends \BaseController {

	private $locationRepository;
	private $imageRepository;

	public function __construct(ImageRepository $imageRepository)
	{
		$this->imageRepository = $imageRepository;
	}
}

?>