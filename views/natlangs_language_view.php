<?php

namespace WorldlangDict;

// TODO: i18n

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlangs_language">

<h1><?= sprintf($config->getTrans('natlangs language view title'), ucwords($arg)); ?></h1>

<dl>
<? foreach($data as $term) { ?>
    <div>
    <? if (isset($dict[$term])) : ?>
        <dt lang="<?= WL_CODE_FULL; ?>"><?=
            WorldlangDictUtils::makeLink(text:$term,
                config:$config, request:$request,
                controller:'word', arg:urlencode($term)
            );?>
        </dt>
        <dd>
        <? if (!empty($dict[$term]['class'])) : ?>
            <span class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$dict[$term]['class'];?></a>)</span>
        <? endif; ?>
            <?=$dict[$term]['translation']?>
        </dd>
    <? else:
        error_log("Missing `{$term}` from \$dict[] in `natlangs_language_view.php`."); ?>
        <dt lang="<?= WL_CODE_FULL; ?>"><?=$term?></dt><dd></dd>
    <? endif; ?>
</div>


<? } ?>
</dl>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
