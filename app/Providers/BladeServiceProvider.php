<?php

namespace App\Providers;

use Blade;
use File;
use View;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
     /**
      * Bootstrap services.
      *
      * @return void
      */
     public function boot()
     {
          // Declare our custom directives here

          Blade::directive('css', function ($path) {
               // Strip open and close quotes and append /css/
               $path = "/css/" . substr(substr($path, 0, -1), 1);
               // Check if the file exists to prevent an uncaught exception
               try {
                    $href = mix($path);
               } catch (\Exception $e) {
                    $href = $path;
               }
               return '<link rel="stylesheet" href="' . $href . '">';
          });

          Blade::directive('js', function ($path) {
               // Strip open and close quotes and append /js/
               $path = "/js/" . substr(substr($path, 0, -1), 1);
               // Check if the file exists to prevent an uncaught exception
               try {
                    $href = mix($path);
               } catch (\Exception $e) {
                    $href = $path;
               }
               return '<script defer src="' . $href . '"></script>';
          });

          Blade::directive('svg', function ($path) {
               $response = '<?php echo view(\'svg.\' . ' . $path . '); ?>';
               return $response;
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
