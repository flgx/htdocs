<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Resource extends \Eloquent {

    use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;

	protected $fillable = ['action', 'module'];

	public function roles()
    {
        return $this->belongsToMany('Backoffice\Entities\Role', 'roles_resources');
    }
}