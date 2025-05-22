<?php
namespace WorldlangDict;

class WorldlangDictUtils
{
    public static function makeUri(WorldlangDictConfig $config, string $controller, Request $request): string
    {
        return $config->siteUri.$config->lang.'/'.$controller.(!is_string($request) ? $request->linkQuery : "");
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

    public static function redirect(WorldlangDictConfig $config, Request $request, string $controller=""): void
    {
        header('Location: '.WorldlangDictUtils::makeUri($config, $controller, $request));
        exit(0);
    }

    public static function makeLink(WorldlangDictConfig $config, string $controller, Request $request, string|null $text=null): string
    {
        if ($text == null) {
            $text = $controller;
        }
        return '<a href="'.
            WorldlangDictUtils::makeUri($config, $controller, $request).
            '">'.$text.'</a>';
    }
}
