<?php

$asset_manager;/* = \Aphet\Manager::init([
    'modes' => $this->app->config('debug') ? Aphet\Modes::DEV : Aphet\Modes::PROD,
    'request_handler' => new Aphet\Adapter\Slim( $this->app ),
    'assets_paths' => $assets_paths,
    'web_path' => $conf->get('app_path'),
    'public_path' => ROOTPATH .'/public/',
    'cache_file' => ROOTPATH .'/var/cache/aphet.php',
    'extract' => [
        $_rootpath.'/app/routes',
        $_rootpath.'/app/tpl'
    ]
]);*/

function aphet_init( \Aphet\Manager $manager)
{
    global $aphets_manager;
    $aphets_manager = $manager;
}

function aphet_url( $app_path, $name = null )
{
    global $aphets_manager;
    return $aphets_manager->computeAssetsUrl( $app_path, $name );
}

function aphet_htmlHelper($app_path, $html, $name = null )
{
    if(!is_array($app_path)) $app_path = array($app_path);
    $aphets_url = aphet_url( $app_path, $name );
    
    return implode('',array_map(function($path) use($html){
        return sprintf($html,$path);
    },$aphets_url));
    
}

function aphet_link( $aphet_url, $name = null )
{
    return aphet_htmlHelper( $aphet_url, "<link rel='stylesheet' href='%s' >\n", $name );
}
   
function aphet_script($aphet_url, $name = null )
{
    return aphet_htmlHelper($aphet_url, "<script src='%s'></script>\n", $name);
}   
