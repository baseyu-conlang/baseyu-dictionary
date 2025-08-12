<?php
namespace WorldlangDict;

/**
 * Calls the appropriate function based on the url.
 */
class Request
{
    public $lang;
    public $controller;
    public $options;
    public $arguments;
    public $incomplete;
    public $path;
    public $linkQuery;
    public $url;

    public function __construct(WorldlangDictConfig $config)
    {
        $this->url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_VALIDATE_URL);
        $parsedUrl = parse_url(mb_strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI'), encoding:"UTF-8"));
        $this->path = isset($parsedUrl['path']) ? explode('/', $parsedUrl['path']) : [];

        if (isset($parsedUrl['query'])) {
            //$this->linkQuery = '?'.$parsedUrl['query'];
            $this->linkQuery = '';
            mb_parse_str($parsedUrl['query'], $this->options);
        } else {
            $this->linkQuery = '';
            $this->options = '';
        }

        // Find num of parameters by comparing path to URI (minus 3 for domain)
        $requestSize = sizeof($this->path);
        if ($requestSize && empty($this->path[$requestSize-1])) {
            $requestSize -= 1;
        }
        $requestSkip = sizeof(explode('/', $config->siteUri))-3;
        $requestSize = $requestSize-$requestSkip;

        // Let's get to the request content!
        $this->lang = $config->lang;
        $this->controller = '';
        $this->arguments = [];

        if ($requestSize >= 1) {
            $req_lang = filter_var($this->path[$requestSkip], FILTER_SANITIZE_URL);
            if (isset($config->userLangs[$req_lang])) {
                $this->lang = $req_lang;
            }
            if ($requestSize >= 2) {
                $this->controller = filter_var($this->path[$requestSkip+1], FILTER_SANITIZE_URL);
                if ($requestSize >= 3) {
                    for ($i = 2; $i < $requestSize; $i++) {
                        $this->arguments[$i-2] =
                            urldecode($this->path[$requestSkip+$i]);
                    }
                }
            }
        }

        if ($requestSize <= 0) {
            $this->incomplete = true;
        } else {
            $this->incomplete = false;
        }
    }
}
