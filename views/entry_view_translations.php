<?;

namespace WorldlangDict;

?>
<section class="translation">
    <p><?

if (!empty($entry['trans'][$request->lang])):
    $gstart = true;
    
    foreach($entry['trans'][$request->lang] as $group):
        if (!$gstart) :
            ?>; <?
        endif;
        $gstart = false;
        $tstart = true;
        
        
        foreach($group as $translation):
            if (!$tstart) :
                ?>, <?
            endif;
            $tstart = false;
            $trans_note_preceeding = '';
            $trans_note_following = '';

            // var_dump($translation);
            // Check for preceeding translation note using colon
            if (($pos = mb_strpos($translation, ':', encoding:"UTF-8")) !== false) {
                $trans_note_preceeding = mb_trim(substr($translation, 0, $pos+1), encoding:"UTF-8");
                $translation = mb_trim(mb_substr($translation, $pos+1, encoding:"UTF-8"), encoding:"UTF-8");
            }
            
            $slug = mb_trim(mb_strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation)), encoding:"UTF-8"), encoding:"UTF-8");  // regex removes parentheticals (...)

            // TODO: link this!
            if (!str_contains($translation, '<a')) :
                echo($trans_note_preceeding.' ');
                ?><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'natlang-search', arg:$slug, request:$request) ?>" class="hl h1"><?=$translation?></a><?
                echo(' '.$trans_note_following);
            else:
                ?><span class="hl h1"><?=$translation?></span><?
            endif;
        endforeach;
    endforeach;
endif;

?></p>





<?
if (isset($entry['entry notes'])) :
    foreach ($entry['entry notes'] as $type=>$data) :
        switch ($type) :
            case 'am oko':
            case 'kurto lexi':
            case 'kompara':
                ?>  <p><?= $config->getTrans('entry note '.$type); ?>: <?
                $nfirst = true;
                foreach ($entry['entry notes'][$type] as $slug) :
                    $slug = mb_trim($slug, encoding:"UTF-8");
                    if (!$nfirst) {
                        echo(", ");
                    } else {
                        $nfirst = false;
                    }
                    ?>  <a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'word', arg:$slug, request: $request); ?>" lang="<?= WL_CODE_FULL; ?>"><?= $slug; ?></a><?
                endforeach;
                ?>.</p><?
                break;
            case 'gramati':
                $page = explode("#", $data)[0];
                ?>  <p><?= $config->getTrans('entry note gramati'); ?> <a href="<?=$config->grammar_note_url;?><?= $data; ?>"><?= $config->getTrans('entry note gramati '.$page); ?></a>.</p>   <?
                break;
            case 'Nota':
                ?>  <p><?= $entry['entry notes'][$type]; ?></p>  <?
                break;
        endswitch;
    endforeach;


elseif (isset($entry['entry note beta'])) : ?>
    <p><?= $entry['entry note beta']; ?></p>
<?
endif;
?>


</section>
