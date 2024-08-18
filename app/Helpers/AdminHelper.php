<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Config;
use Session;
use Str;
use Artisan;
use File;

class AdminHelper
{
  public static function upload_image(Request $request, $slug=null, $destination='')
  {
      if ($slug === null) {
        $slug = time();
      }
        
      $image = $slug.'-'.time().'.'.$request->image->extension();
      $request->image->move(public_path('uploads/'.$destination), $image);

      return $image;
  }

  public static function upload_image_mobile(Request $request, $slug=null, $destination='')
  {
      if ($slug === null) {
        $slug = time();
      }
      
      $image = $slug.'-responsive-'.time().'.'.$request->image_mobile->extension();
      $request->image_mobile->move(public_path('uploads/'.$destination), $image);

      return $image;
  }

  public static function upload_file(Request $request, $slug=null, $destination='')
  {
      if ($slug === null) {
        $slug = time();
      }

      if(!file_exists(public_path('uploads/'.$destination))) {
        mkdir(public_path('uploads/'.$destination), 0777, true);
      }
        
      $file = $slug.'-'.time().'.'.$request->file->extension();
      $request->file->move(public_path('uploads/'.$destination), $file);

      return $file;
  }

  public static function isNavActive($route_name)
  {
    return Str::contains(\Request::route()->getName(), $route_name) ? 'menu-is-opening menu-open' : false;
  }

  public static function isNavChildActive($route_name)
  {
    return Str::contains(\Request::route()->getName(), $route_name) ? 'active' : false;
  }
  public static function makeView($page)
  {
    $p = explode('/',$page);
    
    $path = resource_path("views/front/".$p[0]);

    if(!File::isDirectory($path))
      File::makeDirectory($path, 0755, true);


    Artisan::call('make:view', [
        'name' => '/front/'.$page
    ]);
  }
  
}