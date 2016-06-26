<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Comment extends \Eloquent {

	use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The columns fillables.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'location_id', 'comment', 'user_created_id', 'block'];
}