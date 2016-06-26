<?php namespace Backoffice\Services\Resource;

use Illuminate\Support\Facades\Facade;

class ResourceFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'backofficeServiceResource'; }

}