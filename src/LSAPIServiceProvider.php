<?php

namespace LSAPI;

/**
* @author    @code4mk <hiremostafa@gmail.com>
* @author    @0devco <with@0dev.co>
* @since     2019
* @copyright 0dev.co (https://0dev.co)
*/

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Config;

class LSAPIServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
   public function boot(\Illuminate\Routing\Router $router)
   {

     // publish config
      $this->publishes([
       __DIR__ . '/../config/lsapi.php' => config_path('lsapi.php'),
      ], 'config');

      // load middleware group

      $throttle = Config::get('lsapi.spa.throttle') ? Config::get('lsapi.spa.throttle') : '60';

      $router->middlewareGroup('lsapi',[
        \LSAPI\Middleware\LSAPIWare::class,
        \LSAPI\Middleware\EtagWare::class,
        'throttle:'. $throttle .',1',
        'bindings'
      ]);

   }

  /**
   * Register any application services.
   *
   * @return void
   */
   public function register()
   {

   }
}
