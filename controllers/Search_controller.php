<?php
namespace WorldlangDict;

class Search_controller
{

    /**
     * Do a partial match search through the natlang index.
     */
    private static function natlang_levenshtein_search(string $term, string $lang, array &$terms) {
        // Finally look for a partial match in index
        
        // Convert term to ASCII for `levenshtein()`.
        // Turns multibyte accent characters to ?
        $term = mb_convert_encoding($term, "ASCII");
        
        $partialMatches = [];
        foreach ($terms as $key=>$data) {
            if (levenshtein($term, mb_convert_encoding($key, "ASCII"), 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                }
                else {
                    foreach($data as $hit) {
                        $partialMatches[] = $hit;
                    }
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search natlang for term.
     */
    private static function natlang_term_search(object $config, string $lang, string $term, Request $request):array {
        // check if file exists
        if (!file_exists($config->search_terms_location.$lang.".yaml")) {
            throw new Error_404_Exception("Search Language Not Found");
        }
        $terms = yaml_parse_file($config->search_terms_location.$lang.".yaml");

        if (isset($terms[$term])) {
            if (count($terms[$term]) == 1) {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$term][0]));
            } else {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'natlang-search', arg:urlencode($term));
            }
        }
        return self::natlang_levenshtein_search(term:$term, lang:$lang, terms:$terms);
    }



    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     * $results is used by view
     */
    public static function search(object $config, object $request, Page &$page)
    {
        $results = null;
        $term = "";
        if (!empty($request->options[WL_CODE_SHORT])) {
            $lang = WL_CODE_SHORT;
            $term = trim($request->options[WL_CODE_SHORT]);
            $results = self::worldlang_term_search(config:$config, query:$term, page:$page, request:$request);
        } else {
            $lang = array_key_first($request->options);
            if (strcmp($lang, WL_CODE_SHORT)===0) {
                $lang = array_key_last($request->options);
            }
            if (empty($request->options[$lang])) {
                WorldlangDictUtils::redirect(config:$config, request:$request);
            }
            $term = trim($request->options[$lang]);
            $results = self::natlang_term_search(config:$config, lang:$lang, term:$term, request:$request);
        }
        $page->setTitle($config->getTrans('search result title').': '.$term);
        require_once('views/search_results_view.php');

        return;
    }



    /**
     * Do a partial match search through the Globasa index.
     */
    private static function worldlang_levenshtein_search(string $term, array &$index) {
        // Finally look for a partial match in index
        $partialMatches = [];
        foreach ($index as $key=>$data) {
            if (levenshtein($term, $key, 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                }
                else {
                    $partialMatches[$data] = $data;
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search worldlang index for term.
     * 
     * If key exists in index:
     * - if only one entry, redirect to that entry.
     * - if search term has exact match, redirect to that entry.
     * - if multiple matches, return array.
     * 
     * Else, return results of near matches.
     */
    private static function worldlang_term_search(object $config, string $query, object $request, Page &$page):array {
        $terms = yaml_parse_file($config->search_terms_location.WL_CODE_SHORT.'.yaml');
        
        if (array_key_exists($query, $terms)) {
            if (count($terms[$query])==1) {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$query][0]));
            }
            elseif (($key = array_search($query, $terms[$query])) !== false) {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$query][$key]));
            }
            else {
                return $terms[$query];
            }

        } else {
            $index = yaml_parse_file($config->index_location);
            return self::worldlang_levenshtein_search($query, $index);
        }
    }

}