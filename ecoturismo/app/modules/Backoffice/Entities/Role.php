<?php namespace Backoffice\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Backoffice\Traits\UserCreatedTrait;
use Backoffice\Traits\SoftUserDeletingTrait;
use Backoffice\Traits\UserUpdatedTrait;

class Role extends \Eloquent {

    use SoftDeletingTrait, UserCreatedTrait, UserUpdatedTrait, SoftUserDeletingTrait;
    
	protected $fillable = ['name'];

	public function resources()
    {
        return $this->belongsToMany('Backoffice\Entities\Resource', 'roles_resources');
    }

    public function scopeWithoutRoot($query)
    {
        return $query->where('id', '<>', \Config::get('auth.root.role'));
    }
}