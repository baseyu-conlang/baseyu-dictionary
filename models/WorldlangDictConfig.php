<?php
namespace WorldlangDict;

class WorldlangDictConfig
{
    public string $api2Path;
    public string $i18nFile;
    public string $auxLang;
    public string $auxLangCap;
    public string $basic_location;
    public string $custom_id;
    public string $db_database;
    public string $db_dsn;
    public string $db_pass;
    public string $db_prefix;
    public string $db_user;
    public string $debugging;
    public string $defaultLang;
    public array $dictionary;
    public string $dictionaryFile;
    public string $examples_location;
    public string $grammar_note_url_template;
    public string $grammar_note_url;
    public string $grammar_url_template;
    public string $grammar_url;
    public string $index_location;
    public string $internationalizationFile;
    public string $lang;
    public string $langCap;
    public string $languages;
    public string $languagesFile;
    public string $maintenance_message;
    public string $min_location ;
    public Page $page;
    public string $search_terms_location ;
    public string $site_logo_url;
    public string $siteName;
    public string $siteUri;
    public string $startTime;
    public string $stats_location;
    public string $tag_location;
    public string $template;
    public string $templatesFolder;
    public string $templatePath;
    public string $templateUri;
    public array $trans;
    public array $userLangs;
    public string $worldlang_name;
    public string $worldlang;
    public string $worldlangCap;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function setLang(string $lang, string|null $aux=null): void
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

    public function setWorldlang(string $lang): void
    {
        $this->worldlang = strtolower($lang);
        $this->worldlangCap = ucfirst($lang);
    }

    public function setUserLangs(array $langs): void {
        $this->userLangs = $langs;
    }

    public function setTemplate(string $name, string|null $folder=null): void
    {
        $this->template = $name;
        if (!is_null($folder)) {
            $this->templatesFolder = $folder;
        } else {
            $this->templatesFolder = $name;
        }

        $this->templatePath = "./".$this->templatesFolder.'/'.$this->template.'/';
        $this->templateUri = $this->siteUri.$this->templatesFolder.'/'.$this->template.'/';
    }

    public function getTrans(string $textId): string
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

    public function getWord(string $word): array
    {
        return $this->dictionary[$this->defaultLang][$word];
    }
}
