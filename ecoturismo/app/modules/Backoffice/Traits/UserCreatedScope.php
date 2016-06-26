<?php namespace Backoffice\Traits;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class UserCreatedScope implements ScopeInterface
{
	public function apply(Builder $builder)
	{   
		if($this->isInsert($builder)) {
			if( ! $builder->getModel()->user_created_id && \Auth::user()) {
				$builder->getModel()->user_created_id = \Auth::user()->id;
			}
		}
	}


	public function remove(Builder $builder)
	{

	}

	private function isInsert($builder)
	{
		return $builder->getModel()->id === null;
	}
}