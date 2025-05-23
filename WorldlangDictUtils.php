<?php
namespace WorldlangDict;

class WorldlangDictUtils
{
    public static function makeUri(WorldlangDictConfig $config, Request $request, string $controller, ?string $arg=null): string
    {
        if (isset($config->routes[$controller])) $controller = $config->routes[$controller];
        return $config->siteUri.$config->lang.'/'.$controller.(!empty($arg) ? '/'.$arg : '').$request->linkQuery;
    }

    public static function changeLangUri(WorldlangDictConfig $config, Request $request, string $lang): string
    {
        if (is_null($request->arguments)) {
            $args = '';
        } elseif (sizeof($request->arguments) == 1) {
            $args = $request->arguments[0];
        } else {
            $args = implode('/', $request->arguments);
        }
        return $config->siteUri.$lang.'/'
            .$request->controller.'/'
            .$args
            .$request->linkQuery;
    }

    public static function redirect(WorldlangDictConfig $config, Request $request, string $controller="", ?string $arg=null): void
    {
        header('Location: '.WorldlangDictUtils::makeUri(config:$config, controller:$controller, arg:$arg, request:$request));
        exit(0);
    }

    public static function makeLink(WorldlangDictConfig $config, Request $request, string $controller, ?string $arg=null, ?string $text=null): string
    {
        if ($text == null) $text = $controller;
        return '<a href="'.
            WorldlangDictUtils::makeUri(config:$config, controller:$controller, arg:$arg, request:$request).
            '">'.$text.'</a>';
    }
}
