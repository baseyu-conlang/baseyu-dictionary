<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath ."partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="tags">

<? $exists = isset($defs[$tag]); ?>
<? if ($exists) : ?>
  <h1><?= $config->getTrans('single tag view') ?>: <?= $defs[$tag]['term']; ?></h1>
  <p>
    <em>(<?= $defs[$tag]['class'];?>)</em>&nbsp;
    <?= $defs[$tag]['translation'] ?>
  </p>
  <? else : ?>
    <h1><?= $config->getTrans('single tag view') ?>: <?= $tag; ?></h1>
  <? endif; ?>
  <hr/>
  <? if (!empty($tags[$tag])): ?>

    <dl>
    <?php
    foreach($tags[$tag] as $slug):
        if (!isset($defs[$slug])) continue;
        $def = $defs[$slug];
        
      ?>
      <div>
        <dt><?= WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($slug),
                $request,
                $defs[$slug]['term']
            ); ?></dt>
        <dd>
        <em>(<?=$defs[$word]['class'];?>)</em>&nbsp;
        <?=$defs[$slug]['translation'];?>
        </dd>
      </div>
    <? endforeach; ?>
    </dl>
  <? endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>