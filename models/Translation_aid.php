<?php
namespace WorldlangDict;

class Translation_aid
{



    public static function transAideBulkTranslate($config, $request) {
        $text = isset($_REQUEST['text']) ? $_REQUEST['text'] : null;
        $result = [];
        
        // Old code that broke text apart by line return
        // if (!empty($words)) {
            //     $words = preg_split("@[\s+　]@u", mb_trim($text));
        // }
        
        // Break text up by sentence.
        
        // “” ‘’
        // '/(?<=[.?!"\'])\s+(?=[a-z])/i'
        // /(?<=[.?!"\'])\s+(?=[a-zA-Z0-9])/
        if (!empty($text)) {
            // echo("<pre>");
            $sentences = preg_split('/(?<=[.?!"\'”’‽])\s+/u', $text);

            foreach($sentences as $key=>$sentence) {
                // echo("-".PHP_EOL);
                $sentenceResult = new \stdClass();
                $sentenceResult->sentence = $sentence;
                $sentence = mb_strtolower($sentence, encoding:"UTF-8");
                // Remove punctuation using PCRE unicode character class for all punctuation characters
                $sentence = preg_replace('/\p{P}/u', '', $sentence);
                // $sentence = preg_replace('/[“”‘’]/u', '', $sentence);
                
                // Split on whitepace
                $sentenceResult->words = preg_split("/\s+/u", mb_trim($sentence, encoding:"UTF-8"));
                // var_dump($sentenceResult->words);
                $result[] = $sentenceResult;
            }
            
        }
        // var_dump($result); die;
        return $result;
        
    }


}
