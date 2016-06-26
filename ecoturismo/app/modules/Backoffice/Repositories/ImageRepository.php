<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Image;

class ImageRepository extends BaseRepository
{
	public function getModel()
	{
		return new Image;
	}
}

?>