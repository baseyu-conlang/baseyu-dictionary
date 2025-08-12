<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="translation_aid">

    
    <h1><?=$config->getTrans('translation aide title');?></h1>
    <p><?=$config->getTrans('translation aide description');?></p>

<? $words = isset($_REQUEST['text']) ? $_REQUEST['text'] : null; ?>
    <form action="<?=WorldlangDictUtils::makeUri(config:$config, controller:'tool', arg:'basatayti', request:$request);?>" method="post" accept-charset="utf-8">
        <textarea name="text"><?=$words;?></textarea>
        <input type="submit" value="<?=$config->getTrans('translation aide translate button')?>" />
    </form>
<? if (!empty($sentences)) : ?>

    <? foreach($sentences as $current) :
        if (empty($current->words)) :
            continue;
        endif; ?>
        <h3><?=$current->sentence;?></h3>
            <dl>
        <?

        foreach($current->words as $word) :
            $wordClass = "";
            $trans = "";

            if (!empty($word) && isset($dict[$word])) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                    config:$config, request:$request,
                    controller:'word', arg:urlencode($word),
                    text:$word
                );?></dt>
                <dd>
                    <em>(<a href="<?=$config->grammar_url;?>"><?=$dict[$word]['class'];?></a>)</em>&nbsp;
                    <?php
                    if (!empty($dict[$word]['translation'])) :
                        echo($dict[$word]['translation']);
                    else :
                        echo("[Translation not found in this language]");
                    endif; ?>
                </dd>
            </div>
            <?php else : /* word does not exist */
            if (ctype_alpha($word)) {
                $trans = '[Word not found in dictionary]';
            } ?>
                <div>
                    <dt><?= $word ?></dt>
                    <dd>
                        <?=$trans;?>                    
                    </dd>
                </div>
            <? endif; ?>
        <? endforeach; ?>
        </dl>
    <? endforeach; ?>
<? endif;?>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>