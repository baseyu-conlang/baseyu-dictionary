<?php
namespace WorldlangDict;

class WorldlangDictConfig
{
    public $siteUri;
    public $siteName;
    public $template;
    public $lang;
    public $langCap;
    public $auxLang;
    public $auxLangCap;
    public $worldlang;
    public $worldlangCap;
    public $userLangs;
    public $templateFolder;
    public $templatePath;
    public $templateUri;
    public $dictionaryFile;
    public $languagesFile;
    public $internationalizationFile;
    public $dictionary;
    public $languages;
    public $trans;
    public $startTime;
    public $debugging;
    public $grammar_url_template;
    public $grammar_url;
    public $grammar_note_url_template;
    public $grammar_note_url;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function setLang($lang, $aux=null)
    {
        $this->lang = strtolower($lang);
        $this->langCap = ucfirst($lang);
        if (!is_null($aux)) {
            $this->auxLang = strtolower($aux);
            $this->auxLangCap = ucfirst($aux);
        }
        $this->grammar_url = sprintf($this->grammar_url_template, $this->lang);
        $this->grammar_note_url = sprintf($this->grammar_note_url_template, $this->lang);
    }

    public function setWorldlang($lang)
    {
        $this->worldlang = strtolower($lang);
        $this->worldlangCap = ucfirst($lang);
    }

    public function setUserLangs($langs) {
        $this->userLangs = $langs;
    }

    public function setTemplate($name, $folder=null)
    {
        $this->template = $name;
        if (!is_null($folder)) {
            $this->templatesFolder = $folder;
        }

        $this->templatePath = "./".$this->templatesFolder.'/'.$this->template.'/';
        $this->templateUri = $this->siteUri.$this->templatesFolder.'/'.$this->template.'/';
    }

    public function getTrans($textId)
    {
        $missingTranslation = "";
        if (!empty($this->trans[$this->lang][$textId])) {
            // Return localization string
            return $this->trans[$this->lang][$textId];
        } elseif (!empty($this->trans[$this->worldlang][$textId])) {
            // Fall back to worldlang, return that with a notice.
            if ($textId!='Missing Interface Text Translation') {
                $missingTranslation = $this->getTrans('Missing Interface Text Translation');
            }
            return $missingTranslation.$this->trans[$this->worldlang][$textId];
        } elseif (!empty($this->trans[$this->auxLang][$textId])) {
            // Fall back to aux lang (eg., English) with notice
            if ($textId!='Missing Interface Text Translation') {
                $missingTranslation = $this->getTrans('Missing Interface Text Translation');
            }
            return $missingTranslation.$this->trans[$this->auxLang][$textId];
        } else {
            // If all else fails, just say it's broken with i18n string id.
            if ($textId!='Missing Interface Text Translation') {
                $missingTranslation = $this->getTrans('Missing Interface Text Translation');
            } else {
                // End condition for 
                $missingTranslation = '[Missing Interface Text Translation: '.$textId.']';
            }
            return $missingTranslation;
        }
    }

    public function getWord($word)
    {
        return $this->dictionary[$this->defaultLang][$word];
    }


    public function makeLink($request, $text=null, $lang=null)
    {
        if ($lang == null) {
            $lang = $this->lang;
        }
        if ($text == null) {
            $text = $request;
        }
        return '<a href="'.$this->siteUri.$lang.'/'.$request.$this->page->linkQuery.'">'.$text.'</a>';
    }
}
