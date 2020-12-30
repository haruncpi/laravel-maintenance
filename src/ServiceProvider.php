<?php namespace Haruncpi\LaravelMaintenance;



use Haruncpi\LaravelMaintenance\Console\DownCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        
    }

    
    public function register()
    {
        $this->app->extend('command.down', function () {
            return new DownCommand();
        });
    }

}
