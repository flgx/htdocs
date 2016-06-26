<?php namespace Backoffice\Traits;

use Backoffice\Traits\UserCreatedScope;

trait UserCreatedTrait 
{

	/**
	 * Boot the soft deleting trait for a model.
	 *
	 * @return void
	 */
	public static function bootUserCreatedTrait()
	{
		static::addGlobalScope(new UserCreatedScope);
	}

}
