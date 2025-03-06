<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath ."partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="tags">

<h1><?= $config->getTrans('tags title') ?></h1>
<dl class="">
<?
foreach ($tags as $tag=>$words):
    $exists = isset($defs[$tag]);
?>
  <div>
    <dt><?= WorldlangDictUtils::makeLink($config, "lexilari/".$tag, $request, $tag); ?></dt>
    <dd>
        <? if ($exists) : ?>
          <em>(<a href="<?=$config->grammar_url;?>"><?=$defs[$tag]['class'];?></a>)</em>&nbsp;
          <?=$defs[$tag]['translation'];?>
        <? endif; ?>
        <span class="hl h1"><?=count($words) ?></span>
    </dd>
  </div>
<?php endforeach; ?>
</dl>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>