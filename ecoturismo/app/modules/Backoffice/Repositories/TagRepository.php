<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Tag;

class TagRepository extends BaseRepository
{
	public function getModel()
	{
		return new Tag;
	}

	public function find($take, $skip, $sort, $filter)
	{ 
		return Tag::select('tags.id', 'tags.name', 'parent_tag.name as parent', 'tags.locations_quantity')
						->leftJoin('tags as parent_tag', 'tags.parent_tag_id', '=', 'parent_tag.id')
						->skip($skip)
						->take($take)
						->orderBy($sort['field'], $sort['order'])		
						->get();
	}

	public function findWithoutParent()
	{
		return Tag::select('id', 'name', 'icon', 'marker')
					->whereNull('parent_tag_id')
					->orderBy('name', 'ASC')->get()->toArray();
	}

	public function findChildren($parentTagId)
	{
		return Tag::select(\DB::raw('tags.id id, tags.name, tags.icon, tags.marker, count(location_tag.tag_id) count'))
					->leftJoin('location_tag','location_tag.tag_id', '=', 'tags.id')
					->where('tags.parent_tag_id', '=', $parentTagId)
					->groupBy('location_tag.tag_id')
					->get()->toArray();
	}

	public function findAll()
	{
		return Tag::select(\Db::raw('tags.id id'), \Db::raw('IF(tags.parent_tag_id IS NULL, tags.name, CONCAT(parent_tag.name, " - ", tags.name)) name'))
				  ->leftJoin('tags as parent_tag', 'tags.parent_tag_id', '=', 'parent_tag.id')
				  ->orderBy('name', 'ASC')->get();
	}

	public function findAllChildByCombo()
	{
		return Tag::select(\Db::raw('tags.id id'), \Db::raw('IF(tags.parent_tag_id IS NULL, tags.name, CONCAT(parent_tag.name, " - ", tags.name)) name'))
				  ->leftJoin('tags as parent_tag', 'tags.parent_tag_id', '=', 'parent_tag.id')
				  ->whereNotNull('tags.parent_tag_id')
				  ->orderBy('name', 'ASC')->get();
	}

	public function findAllWithout($tagId = 0)
	{
		return Tag::select(\Db::raw('tags.id id'), \Db::raw('IF(tags.parent_tag_id IS NULL, tags.name, CONCAT(parent_tag.name, " - ", tags.name)) name'))
				  ->leftJoin('tags as parent_tag', 'tags.parent_tag_id', '=', 'parent_tag.id')
				  ->where('tags.id', '<>', $tagId)
				  ->whereNull('tags.parent_tag_id')
				  ->orderBy('name', 'ASC')->get();
	}

	public function findByParentTagId($parentTagId)
	{
		return Tag::where('parent_tag_id', '=', $parentTagId);
	}

	public function findById($id)
	{
		return Tag::find($id);
	}

	public function findName($id)
	{
		$tag = $this->findById($id);

		return $tag->name;
	}

	public function count($filter)
	{
		return  Tag::count();
	}

	public function hasChildren($tagId)
	{
		$children = Tag::where('parent_tag_id', '=', $tagId)->count();

		if($children > 0) {
			return true;
		} 

		return false;
	}

	public function destroy($id)
	{
		$locationTag = \DB::table('location_tag')->where('tag_id', '=', $id)->take(1)->get();

		if( ! $locationTag) {
			if( ! $this->hasChildren($id) ) {
				Tag::destroy($id);

				return true;
			}
		}

		return false; 
	}

	public function findMarkers()
	{
		return [
			['id'=>'01.png', 'name' => 'Pesca'],
			['id'=>'02.png', 'name' => 'Ski'],
			['id'=>'03.png', 'name' => 'Camping'],
			['id'=>'04.png', 'name' => 'Agua'],
			['id'=>'05.png', 'name' => 'Arbol'],
			['id'=>'06.png', 'name' => 'Bicicleta'],
			['id'=>'07.png', 'name' => 'Playa'],
			['id'=>'08.png', 'name' => 'Trekking'],
			['id'=>'09.png', 'name' => 'Montaña'],
			['id'=>'10.png', 'name' => 'Kayak'],
			['id'=>'11.png', 'name' => 'Nube'],
			['id'=>'12.png', 'name' => 'Ala Delta'],
			['id'=>'13.png', 'name' => 'Hostel'],
			['id'=>'14.png', 'name' => 'Alojamiento'],
			['id'=>'15.png', 'name' => 'Hábitat de Ribera'],
			['id'=>'16.png', 'name' => 'Buceo'],
			['id'=>'17.png', 'name' => 'Paracaidas'],
			['id'=>'18.png', 'name' => 'Windsurf'],
			['id'=>'19.png', 'name' => 'Snowboard'],
			['id'=>'20.png', 'name' => '4x4'],
			['id'=>'21.png', 'name' => 'Surf'],
			['id'=>'22.png', 'name' => 'Cabalgata'],
			['id'=>'23.png', 'name' => 'Escalada'],
		];
	}

	public function findIcons()
	{
		return [
			['id'=>'fa fa-tint'     	, 'name' => '<i class="fa fa-tint"></i> &nbsp; Agua'],
			['id'=>'fa fa-plane'      	, 'name' => '<i class="fa fa-plane"></i> &nbsp; Avión'],
			['id'=>'fa fa-glass'      	, 'name' => '<i class="fa fa-glass"></i> &nbsp; Bares'],
			['id'=>'fa fa-coffee'      	, 'name' => '<i class="fa fa-coffee"></i> &nbsp; Café'],
			['id'=>'fa fa-camera'      	, 'name' => '<i class="fa fa-camera"></i> &nbsp; Camara'],
			['id'=>'fa fa-bell'        	, 'name' => '<i class="fa fa-bell"></i> &nbsp; Campana'],
			['id'=>'fa fa-shopping-cart', 'name' => '<i class="fa fa-shopping-cart"></i> &nbsp; Carrito'],
			['id'=>'fa fa-beer'        	, 'name' => '<i class="fa fa-beer"></i> &nbsp; Cerveza'],
			['id'=>'fa fa-heart'        , 'name' => '<i class="fa fa-heart"></i> &nbsp; Corazón'],
			['id'=>'fa fa-cutlery'      , 'name' => '<i class="fa fa-cutlery"></i> &nbsp; Cubiertos'],
			['id'=>'fa fa-trophy'     	, 'name' => '<i class="fa fa-trophy"></i> &nbsp; Deportes'],			
			['id'=>'fa fa-building-o'   , 'name' => '<i class="fa fa-building-o"></i> &nbsp; Edificio'],			
			['id'=>'fa fa-shield'   	, 'name' => '<i class="fa fa-shield"></i> &nbsp; Escudo'],			
			['id'=>'fa fa-leaf'     	, 'name' => '<i class="fa fa-leaf"></i> &nbsp; Hoja'],			
			['id'=>'fa fa-home'     	, 'name' => '<i class="fa fa-home"></i> &nbsp; Hospedaje'],			
			['id'=>'fa fa-info-circle'	, 'name' => '<i class="fa fa-info-circle"></i> &nbsp; Información'],
			['id'=>'fa fa-gamepad'		, 'name' => '<i class="fa fa-gamepad"></i> &nbsp; Juegos'],
			['id'=>'fa fa-book'			, 'name' => '<i class="fa fa-book"></i> &nbsp; Libro'],
			['id'=>'fa fa-plus-square'	, 'name' => '<i class="fa fa-plus-square"></i> &nbsp; Más'],
			['id'=>'fa fa-music'		, 'name' => '<i class="fa fa-music"></i> &nbsp; Música'],
			['id'=>'fa fa-picture-o'	, 'name' => '<i class="fa fa-picture-o"></i> &nbsp; Paisaje'],
			['id'=>'fa fa-cloud'		, 'name' => '<i class="fa fa-cloud"></i> &nbsp; Nube'],
			['id'=>'fa fa-globe'		, 'name' => '<i class="fa fa-globe"></i> &nbsp; Planeta'],
			['id'=>'fa fa-money'		, 'name' => '<i class="fa fa-money"></i> &nbsp; Plata'],
			['id'=>'fa fa-gift'			, 'name' => '<i class="fa fa-gift"></i> &nbsp; Regalo'],
			['id'=>'fa fa-credit-card'  , 'name' => '<i class="fa fa-credit-card"></i> &nbsp; Tarjeta'],
			['id'=>'fa fa-truck'      	, 'name' => '<i class="fa fa-truck"></i> &nbsp; Transporte'],
			['id'=>'fa fa-suitcase'     , 'name' => '<i class="fa fa-suitcase"></i> &nbsp; Valija'],
			['id'=>'fa fa-picture-o'    , 'name' => '<i class="fa fa-picture-o"></i> &nbsp; Montaña'],
		];
	}
}