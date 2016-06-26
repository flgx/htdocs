<?php namespace Backoffice\Traits;

use Backoffice\Traits\SoftUserDeletingScope;

trait SoftUserDeletingTrait 
{

	/**
	 * Boot the soft deleting trait for a model.
	 *
	 * @return void
	 */
	public static function bootSoftUserDeletingTrait()
	{
		static::addGlobalScope(new SoftUserDeletingScope);
	}

}
