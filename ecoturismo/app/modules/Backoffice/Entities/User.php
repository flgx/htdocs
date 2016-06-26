<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class User extends \Eloquent {

	use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The columns fillables.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'enabled', 'password', 'role_id', 'user_created_id', 'facebook_id', 'image', 'about_me'];


    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    public function scopeWithoutRoot($query)
    {
        return $query->where('role_id', '<>', \Config::get('auth.root.role'));
    }
}
