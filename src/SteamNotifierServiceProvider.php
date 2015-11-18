<?php namespace Magnetion\SteamNotifier;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class SteamNotifierServiceProvider extends ServiceProvider {

    protected $defer = false;

    protected $commands = [
        'Magnetion\SteamNotifier\SteamStatus'
    ];

    public function boot()
    {
        $app = $this->app;
    }


    public function register()
    {
        $this->commands($this->commands);
    }

}