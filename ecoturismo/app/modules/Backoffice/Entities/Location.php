<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Location extends \Eloquent {

	use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';

	/**
	 * The columns fillables.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description','lat', 'lng', 'enabled', 'ranking', 'views','location_id','url'];


	public function tags()
    {
        return $this->belongsToMany('Backoffice\Entities\Tag', 'location_tag');
    }
	public function images()
    {
        return $this->belongsToMany('Backoffice\Entities\Image', 'location_image');
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', '=', 1);
    }
}