<?php
namespace WorldlangDict;

use Throwable;

class Error_controller
{
    public static function error_404(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function invalid_request(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function data_error(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function wtf(object $config, object $request, object $page, Throwable $error):void {
        error_log("WTF Error logged:\n\n".$error."\n\nRequest URL: ".$request->url."\n", 0);
        if ($config->debugging) {
            echo('<pre style="text-wrap: wrap; background-color: salmon;">');
            echo(nl2br($error));
            echo('</pre></body></html>');
            die();
        } else {
            include_once('views/error_wtf_view.php');
        }
    }
}