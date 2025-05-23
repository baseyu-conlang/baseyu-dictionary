<?php
namespace WorldlangDict;

class Page
{
    public $title;
    public $content;
    public $siteName;
    public $description;
    public $show_input=false;

    public function __construct(string $siteName)
    {
        $this->title = $this->siteName = $siteName;
        $this->content = '';
        $this->description = '';
    }

    public function setTitle(string $title): void
    {
        $this->title = $title . ' &mdash; ' . $this->siteName;
    }
}
