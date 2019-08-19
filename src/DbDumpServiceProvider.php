<?php

namespace Amanatjuwel\DbDump;

use Illuminate\Support\ServiceProvider;

class DbDumpServiceProvider extends ServiceProvider
{
	public function boot(){

		//route
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');

		//views
		$this->loadViewsFrom(__DIR__.'/views', 'db-dump');

		//merge config 
		$this->mergeConfigFrom(
	        __DIR__.'/config/db-dump.php', 'db-dump'
	    );

		//publish to views folder
		$this->publishes([
		    __DIR__.'/config/db-dump.php' => config_path('db-dump.php'),
	        __DIR__.'/views' => resource_path('views/vendor/db-dump'),
	    ]);


	}

	public function register(){
		

	}
}