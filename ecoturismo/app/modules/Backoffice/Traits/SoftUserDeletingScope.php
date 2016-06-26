<?php namespace Backoffice\Traits;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class SoftUserDeletingScope implements ScopeInterface
{
	public function apply(Builder $builder)
	{   
		$builder->onDelete(function(Builder $builder)
		{
			return $builder->getModel()->user_deleted_id = \Auth::user()->id;
		});
	}

	public function remove(Builder $builder)
	{

	}
}