<?php namespace Backoffice\Services\Resource;

use Backoffice\Repositories\ResourceRepository;

class Resource
{
	protected $available;
	protected $resourceRepository;

	public function __construct(ResourceRepository $resourceRepository)
	{	
		$this->resourceRepository = $resourceRepository;
		$this->available 		  = $this->getAvailable();		
	}

	public function can($module, $action)
	{  
		if(\Auth::check() && \Auth::user()->enabled) {
			if( \Auth::user()->role_id == \Config::get('auth.root.role') || (isset($this->available[$module][$action]) && $this->available[$module][$action]) ){
				return true;
			}

			return false;
		} 
	}

	public function isRoot()
	{
		if(\Auth::check()) {
			return (\Auth::user()->role_id == \Config::get('auth.root.role'));
		}

		return false;
	}

	private function getAvailable()
	{		
		$available = [];

		if (\Auth::check())
		{
			$resources = $this->resourceRepository->findByRole(\Auth::user()->role_id);

			foreach ($resources as $resource) {

				if( ! isset($available[$resource->module])) {
					$available[$resource->module] = [];
				}

				$available[$resource->module][$resource->action] = true;
			}
		}
		return $available;
	}
}