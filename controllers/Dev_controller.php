<?php
namespace WorldlangDict;

class Dev_controller
{
    public static function dash($config, $request, &$page)
    {
        $page->setTitle("Dev Dashboard");
        $page->content = "Hello, world!";
        include_once('views/dev_dashboard_view.php');
    }
}
