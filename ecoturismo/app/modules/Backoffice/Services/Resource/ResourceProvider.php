<?php namespace Backoffice\Services\Resource;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Backoffice\Repositories\ResourceRepository;


class ResourceProvider extends ServiceProvider 
{

    public function register()
    {  
        $this->registerProvider();
        $this->setAliases();
    }

    public function registerProvider()
    {
        $this->app->bind('backofficeServiceResource', function($app)
        {
            return new Resource(new ResourceRepository);
        });
    }

    public function setAliases()
    {
        $this->app->booting(function ()
        {
            $loader = AliasLoader::getInstance();

            $loader->alias('BackofficeResource', 'Backoffice\Services\Resource\ResourceFacade');
        });
    }

}