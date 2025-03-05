<?php namespace WorldlangDict; ?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>

<h1><?=$config->getTrans('search result title')?>: <?=$term?></h1>

<? if (sizeof($results)) : ?>
<dl>
    
    <? foreach ($results as $word) :
        if (!file_exists($config->api2Path."terms/{$word}.yaml")) {
            // TODO: Error handling by saying or logging the error
            continue;
        }
        $entry = yaml_parse_file($config->api2Path."terms/{$word}.yaml");
        if (empty($entry['term'])) return ""; ?>
        <div>
        <dt><?
            echo(WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($entry['slug']),
                $request,
                $entry['term']
            ));
        ?></dt>
        <dd>
            <? if (isset($entry['word class']) && !empty($entry['word class'])) :
                ?> <span class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$entry['word class'];?></a>)</span>&nbsp; <?
            endif; ?>
            <?=$entry['trans html'][$request->lang];?>
        </dd>
        </div>
<? endforeach; ?>
</dl>

<? else:
    // Otherwise, say nothing was found.
    echo($config->getTrans('no matches found'));
endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>