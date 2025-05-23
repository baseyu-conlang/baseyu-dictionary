<?php
namespace WorldlangDict;
?>

    <h1><?=$config->getTrans('homonym terminator title');?></h1>
    <p><?=$config->getTrans('homonym terminator description');?></p>

<? if ($page->show_input): ?>
    <form class="tool" action="<?=WorldlangDictUtils::makeUri(config:$config, controller:'tool', arg:'samaeskri-lexi', request:$request);?>" method="get">
        <input type="text" name="candidate" placeholder="<?=$config->getTrans('homonym terminator new placeholder');?>" />
        <input type="submit" value="<?=$config->getTrans('homonym terminator new button');?>" />
    </form>
<? endif; 

    if (empty($homonyms)) {
        $page->content .= $config->getTrans("none found");
    }
?>
    <ul>
<?
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
        // $d[0] = '';
        // $d[1] = '';
        // $d[2] = '';

        // foreach ($nearMatches as $word=>$data) {
        //     foreach ($data as $match=>$distance) {
        //         $d[$distance] .= '<li>'.$word.': '. $match.'</li>';
        //     }
        // }

    foreach ($homonyms as $word=>$generated_words):

        if (sizeof($generated_words)>1 && (!isset($request->options['candidate']) || isset($generated_words[$request->options['candidate']]))): ?>
            <li>
                <header><?=$word;?></header>
                <section>
                    <?=$config->getTrans('homonym terminator conflicting msg');?>
                    <? foreach($generated_words as $data): ?>
                        <span class="hl"><?
                        if (isset($data['pre'])) echo $data['pre'];
                        echo " <strong>".$data['root']."</strong> ";
                        if (isset($data['suf'])) echo $data['suf'];
                        ?></span>
                    <? endforeach; ?>
                    <? if (isset($dict[$word])): ?>
                    <blockquote><?=$dict[$word]['translation'];?></blockquote>
                    <? endif; ?>
                </section>
            </li>
        <? endif;
    endforeach; ?>
    </ul>