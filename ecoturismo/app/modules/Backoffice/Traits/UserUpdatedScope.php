<?php namespace Backoffice\Traits;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class UserUpdatedScope implements ScopeInterface
{
	public function apply(Builder $builder)
	{   
		if($this->isUpdate($builder)) {
			if(\Auth::user()) {
				$builder->getModel()->user_updated_id = \Auth::user()->id;
			}
		}
	}


	public function remove(Builder $builder)
	{

	}

	private function isUpdate($builder)
	{
		return $builder->getModel()->id !== null;
	}
}