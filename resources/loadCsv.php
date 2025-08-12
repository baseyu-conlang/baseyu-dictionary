<?php
namespace WorldlangDict;

function loadCsv($file)
{
    $dictionaryCSV = fopen($file, 'r');
    if ($dictionaryCSV === false) {
        die("Failed to open dictionary CSV");
    }
    //What does this do on failure? Empty file? No file found?
    $columnNames = fgetcsv($dictionaryCSV);

    while (($word = fgetcsv($dictionaryCSV)) !== false) {
        $newWord = null;
        foreach ($word as $key=>$datum) {
            $newWord[empty($columnNames[$key])?'Word':$columnNames[$key]] = $datum;
        }
        $wordIndex = mb_strtolower(mb_trim($word[0], encoding:"UTF-8"));
        $dictionary[$wordIndex] = $newWord;
    }
    return $dictionary;
}
