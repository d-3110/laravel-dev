<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Storage;
use League\Flysystem\Filesystem;
use Srmklive\Dropbox\Client\DropboxClient;
use Srmklive\Dropbox\Adapter\DropboxAdapter;

class DropboxFilesystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            return new Filesystem(new DropboxAdapter(new DropboxClient($config['accessToken'])));
        });
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
