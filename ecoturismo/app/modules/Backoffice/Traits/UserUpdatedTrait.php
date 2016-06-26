<?php namespace Backoffice\Traits;

use Backoffice\Traits\UserUpdatedScope;

trait UserUpdatedTrait 
{

	/**
	 * Boot the soft deleting trait for a model.
	 *
	 * @return void
	 */
	public static function bootUserUpdatedTrait()
	{
		static::addGlobalScope(new UserUpdatedScope);
	}

}
