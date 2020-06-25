<?php

use Illuminate\Contracts\Routing\UrlGenerator;
if (! function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string  $path
     * @param  mixed   $parameters
     * @param  bool|null    $secure
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return app(UrlGenerator::class);
        }
        if(strpos(\URL::current(),'admin')){
            return app(UrlGenerator::class)->to($path, $parameters, $secure);
        }else{
            return app(UrlGenerator::class)->to(\Session::get('locale').$path, $parameters, $secure);
        }
        
    }
}
if (! function_exists('str_start')) {
    /**
     * Begin a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $prefix
     * @return string
     */
    function str_start($value, $prefix)
    {
        return Str::start($value, $prefix);
    }
}