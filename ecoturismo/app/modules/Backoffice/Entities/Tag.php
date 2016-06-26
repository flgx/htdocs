<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Tag extends \Eloquent {

	use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
	 * The columns fillables.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'parent_tag_id', 'locations_quantity', 'icon', 'marker','user_created_id'];

	public function locations()
    {
        return $this->belongsToMany('Backoffice\Entities\Location', 'location_tag');
    }
}