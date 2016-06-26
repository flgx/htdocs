<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Location;
use Backoffice\Entities\Image;

class LocationRepository extends BaseRepository
{
	public function getModel()
	{
		return new Location;
	}

	public function find($take, $skip, $sort, $filter)
	{ 
		return Location::select('id', 'name', 'views', 'ranking', 'enabled')
						->enabled()
						->skip($skip)
						->take($take)
						->orderBy($sort['field'], $sort['order'])		
						->get();
	}

	public function findAll()
	{
		return Location::select('locations.id', 'locations.name',\DB::raw('locations.name value'), 'locations.image', 'locations.lat', 'locations.lng', 'locations.url', \DB::raw('tags.id tag_id'), \DB::raw('tags.name tag_name'), 'tags.marker', 'ranking', 'views',\DB::raw('location_image.image_id image_id'),\DB::raw('location_image.location_id location_id'))
						->join('location_tag', 'locations.id', '=', 'location_tag.location_id')
						->join('tags', 'tags.id', '=', 'location_tag.tag_id')
						->join('location_image', 'locations.location_id', '=', 'location_image.location_id')
						->whereNotNull('tags.parent_tag_id')
						->enabled()
						->orderBy('locations.name', 'ASC')
						->get()->toArray();
	}
	public function findNearby()
	{
		return Location::select('locations.id', 'locations.name',\DB::raw('locations.name value'), 'locations.image', 'locations.lat', 'locations.lng', 'locations.url', \DB::raw('tags.id tag_id'), \DB::raw('tags.name tag_name'), 'tags.marker', 'ranking', 'views',\DB::raw('location_image.image_id image_id'),\DB::raw('location_image.location_id location_id'))
						->join('location_tag', 'locations.id', '=', 'location_tag.location_id')
						->join('tags', 'tags.id', '=', 'location_tag.tag_id')
						->join('location_image', 'locations.location_id', '=', 'location_image.location_id')
						->whereNotNull('tags.parent_tag_id')
						->enabled()
						->orderBy('locations.name', 'ASC')
						->get()->toArray();
	}
	public function findAllWithOutImages(){
		return Location::select('locations.id', 'locations.name',\DB::raw('locations.name value'), 'locations.image', 'locations.lat', 'locations.lng','locations.url', \DB::raw('tags.id tag_id'), \DB::raw('tags.name tag_name'), 'tags.marker', 'ranking', 'views')
						->join('location_tag', 'locations.id', '=', 'location_tag.location_id')
						->join('tags', 'tags.id', '=', 'location_tag.tag_id')
						->whereNotNull('tags.parent_tag_id')
						->enabled()
						->orderBy('locations.name', 'ASC')
						->get()->toArray();		
	}
	

	public function findAllByParentTagId($tagId)
	{
		return Location::select('locations.id', 'locations.name', 'locations.image', 'locations.lat', 'locations.lng', \DB::raw('tags.id tag_id'), \DB::raw('tags.name tag_name'), 'tags.marker')
						->join('location_tag', 'locations.id', '=', 'location_tag.location_id')
						->join('tags', 'tags.id', '=', 'location_tag.tag_id')
						->where('tags.parent_tag_id', '=', $tagId)
						->enabled()
						->get()->toArray();
	}
	public function deleteOneImage($imageId){
		\DB::table('location_image')->where('id', '=', $imageId)->delete();
		return true;

	}
	public function getLocationId($locationId){
		return Location::select('locations.location_id')
				->where('locations.id', '=', $locationId)
				->enabled()
				->get()->toArray();
	}
	public function getLocationOriginalId($locationId){
		$results= \DB::table('locations')->where('location_id', $locationId)->pluck('id');
		return $results;
	}	
	public function getLocationIdFromUpdate($fromId){

		$results= \DB::table('location_image')->where('id', $fromId)->pluck('location_id');
		return $results;
	}
	public function getLocationImages($locationId){
		return Location::select('locations.id',\DB::raw('location_image.image_id image_id'),\DB::raw('location_image.id location_image_id'))
						->join('location_image', 'locations.location_id', '=', 'location_image.location_id')
						->where('location_image.location_id', '=', $locationId)
						->enabled()
						->get()->toArray();		
	}

	public function findById($id)
	{
		return Location::find($id);
	}

	public function findDetailLocation($id)
	{
		return Location::select('locations.id', 'locations.name', 'locations.image', 'locations.lat', 'locations.lng')
				->whereNotNull('locations.id', '=', $id)
				->orderBy('locations.name', 'ASC')
				->get()->toArray();
	}

	public function findTagsByLocationId($locationId)
	{
		$tagsSelected = [];

		$tags = \Db::table('location_tag')
					->select('tag_id')
					->where('location_id', '=', $locationId)
					->get();

		foreach($tags as $tag) {
			$tagsSelected[] = $tag->tag_id;
		}

		return $tagsSelected;
	}

	public function findChildrenLocationById($childrenTagId)
	{
		return Location::select('locations.id', 'locations.name')
				->join('location_tag', 'locations.id', '=', 'location_tag.location_id')
				->where('location_tag.tag_id', '=', $childrenTagId)
				->enabled()
				->get()->toArray();
	}

	public function findBestRanked($cantToGet)
	{
		return Location::select('locations.id', 'locations.name', 'locations.ranking')	
				->take($cantToGet)
				->orderBy('ranking', 'DESC')		
				->orderBy('name', 'ASC')		
				->get()->toArray();
	}

	public function findBestViews($cantToGet)
	{
		return Location::select('locations.id', 'locations.name', 'locations.views')	
				->take($cantToGet)
				->orderBy('views', 'DESC')		
				->orderBy('name', 'ASC')		
				->get()->toArray();
	}

	public function findViewsLocationByReport($startDate, $endDate)
	{  	
		return  Location::select('locations.id', 'locations.name', \DB::raw('if(locations.enabled,"si","no")'), 'views', 'created_at')
				->enabled()
				->orderBy('locations.views', 'DESC')
				->get()->toArray();
	}

	public function findRankingLocationByReport($startDate, $endDate)
	{  	
		return Location::select('locations.id', 'locations.name', \DB::raw('if(locations.enabled,"si","no")'), 'ranking', 'created_at')
				->enabled()
				->orderBy('locations.views', 'DESC')
				->get()->toArray();
	}
	

	public function findRankingsByUser($id)
	{
		return Location::distinct()
				->select('locations.id', 'locations.name', 'ranking.ranking')	
				->join('ranking', 'ranking.location_id', '=', 'locations.id')
				->where('ranking.user_id', '=', $id)
				->orderBy('name', 'ASC')		
				->get()->toArray();
	}

	public function count($filter)
	{
		return  Location::count();
	}

	public function destroy($id)
	{
		Location::destroy($id);

		return true; 

	}

	public function tagsDestroy($locationId)
	{
		\DB::table('location_tag')->where('location_id', '=', $locationId)->delete();
	}

	public function tagsAttach($locationId, $tags)
	{
		$location = $this->findById($locationId);

		$location->tags()->sync($tags);
	}

	public function addView($locationId)
	{
		$location = $this->findById($locationId);
		$location->views += 1;

		$location->save();
	}
}