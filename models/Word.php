<?php
namespace WorldlangDict;

// Added at home in remote. Add in project. Added offline.
class Word
{
    public $term;
    public $category;
    public $part;
    public $etymology;
    public $relatedWords;
    // public $langSynonyms;
    public $ipaLink;

    // added before online.
    // Create object from CSV dictionary array
    public function __construct($rawWords, $key)
    {
        $this->term       = $rawWords[$key]['Word'];
        $this->category   = $rawWords[$key]['Category'];
        $this->part       = $rawWords[$key]['Part Of Speech'];
        $this->etymology  = $rawWords[$key]['LeksiliAsel'];

        $this->translation['eng'] = $rawWords[$key]['TranslationEng'];
        $this->translation['fra'] = $rawWords[$key]['TranslationFra'];
        $this->translation['rus'] = $rawWords[$key]['TranslationRus'];
        $this->translation['spa'] = $rawWords[$key]['TranslationSpa'];
        $this->translation['zho'] = $rawWords[$key]['TranslationZho'];

        //$this->processEtymology($config);

        // $this->definition = $this->processEntryPart($config, $data, 'Translation');
        // $this->etymology = $this->processEntryPart($config, $data, 'LeksiliAsel');
        // $this->relatedWords = $this->makeRelatedWordsUl($config, $this->processEntryList($data['RelatedWordsGlb']));
        // $this->searchText = $this->processEntryList($data[$app->langCap]);
        // $this->searchText[] = $this->word;
        // $this->ipa($config);
    }

    public function __constructOld($config, $data)
    {
        $this->wordSource = $data;
        $this->term = $data['Word'];
        $this->definition = $this->processEntryPart($config, $data, 'Translation');
        $this->etymology = $this->processEntryPart($config, $data, 'LeksiliAsel');
        $this->etymology = $data['LeksiliAsel'];
        $this->processEtymology($config);
        $this->relatedWords = $this->makeRelatedWordsUl($config, $this->processEntryList($data['RelatedWordsGlb']));
        $this->searchText = $this->processEntryList($data[$app->langCap]);
        $this->searchText[] = $this->word;
        $this->ipa($config);
    }

    private function processEtymology($config)
    {
        if (strpos($this->etymology, '+')) {
            $words = explode(' + ', $this->etymology);
            foreach ($words as $word) {
                $links[] = WorldlangDictUtils::makeLink($config, 'leksi/'.$word, $word);
            }
            $this->etymology = implode(' + ', $links);
        }
    }

    private function makeRelatedWordsUl($config, $listItems)
    {
        if ($listItems !== null && sizeof($listItems) > 0) {
            $result ='<ul>';
            foreach ($listItems as $item) {
                if (isset($config->dictionary['glb'])&&isset($config->dictionary['glb'][$item])) {
                    $result .= '<li>'.$config->makeLink('leksi/'.$item, $item) .': '.$config->dictionary['glb'][$item]['Translation'.$config->langCap].'</li>';
                } else {
                    $result .= '<li>'.$config->makeLink('leksi/'.$item, $item) .': *ERROR*</li>';
                }
            }
            $result .='</ul>';
        } else {
            $result = "";
        }
        return $result;
    }

    private function processEntryPart($config, $data, $part)
    {
        if (!empty($data[$part.$config->langCap])) {
            return $data[$part.$config->langCap];
        } else {
            $result = "";
            if (!empty($data[$part.$config->defaultLangCap])) {
                $result = $data[$part.$config->defaultLangCap];
            } elseif (!empty($data[$part.$config->auxLangCap])) {
                $result = $data[$part.$config->auxLangCap];
            }
            return $config->getTrans('Missing Word Translation').$result;
        }
    }

    private function processEntryList($words)
    {
        if (!empty($words) > 0) {
            $words = explode(";", $words);
            foreach ($words as $index=>$word) {
                $words[$index] = trim($word);
            }
            return $words;
        } else {
            return null;
        }
    }

    private function ipa($config)
    {
        $phrase = strtolower($this->term);
        /*
        c - 'tʃ'
        j - 'dʒ'
        r - 'ɾ'
        x - 'ʃ'
        y - 'j'
        h - 'x'
        */
        $pattern = ['/c/', '/j/', '/r/', '/x/', '/y/', '/h/'];
        $replacement = ['tʃ', 'dʒ', 'ɾ', 'ʃ', 'j', 'x'];
        $result = preg_replace($pattern, $replacement, $phrase);
        $result = "http://ipa-reader.xyz/?text=".$result."&voice=Carla";
        $result = '<a href="'.$result.'"><span class="fa fa-volume-up"></span> '.$config->getTrans('ipa link').'</a>';
        $this->ipaLink = $result;
    }
}
