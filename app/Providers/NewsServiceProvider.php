<?php

namespace App\Providers;

use App\Http\Clients\NewsClient;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NewsClient::class,function(){

            //  $config=$this->app()->get('config')['news'];
            return new NewsClient(
                [
                    'base_uri'=>'https://newsapi.org/v2/',
                    'headers'=>[
                        'Authorization'=>'7210fbd55dc64565b5dd2830b98073bc',
                    ],
                ]
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
