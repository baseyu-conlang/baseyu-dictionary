<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlangs">

<h1><?=$config->getTrans('natlangs title');?></h1>


<ul>
<? foreach($data['etymology source percent'] as $natlang=>$percent) {
  if (!in_array($natlang, OFFICIAL_SOURCE_NATLANGS)) {
    continue;  
  }
  ?>
  <li><strong><?= WorldlangDictUtils::makeLink(config:$config, controller:'natlang', arg:$natlang, request:$request, text:$natlang); ?></a></strong>: <?= $percent; ?>%</li>
<? } ?>
</ul>



</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
