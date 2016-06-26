<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Image extends \Eloquent {

	use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'location_image';

	/**
	 * The columns fillables.
	 *
	 * @var array
	 */
	protected $fillable = ['location_id', 'image_id'];

}