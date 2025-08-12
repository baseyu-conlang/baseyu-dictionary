<?php

namespace WorldlangDict;





class Natlangs_controller
{
    public static function run($config, $request, $page)
    {
        $arg = isset($request->arguments[0]) ? mb_strtolower($request->arguments[0], encoding:"UTF-8") : '';
        
        // TODO: i18n
        $page->description = "Natlangs sources for Globasa words";
        $page->title = "Natlangs";

        switch($arg) {
            case '':
                $data = yaml_parse_file($config->stats_location);
                require_once('views/natlangs_default_view.php');
                break;
            default:
                if (file_exists($config->api2Path.'etymologies/etymology_'.$arg.'.yaml')) {
                    // TODO: security on $arg
                    $data = yaml_parse_file($config->api2Path.'etymologies/etymology_'.$arg.'.yaml');
                    $dict = yaml_parse_file($config->basic_location.$request->lang.'.yaml');
                    require_once('views/natlangs_language_view.php');
                } else {
                    throw new Error_404_exception("Reports module not found.");
                }
                break;
        }
    }
}
