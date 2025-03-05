<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

  <? require_once($config->templatePath . "partials/page-header.php"); ?>
  
  <main id="content">
    
<? /* TODO: i18n */ ?>
<h1>Stats</h1>
<div class="flexy" style="display:flex; flex-direction: row; gap: 2em;">


<!--Lang count-->
<section>
<table>
  <thead>
    <tr><th>Language</th><th>Words</th></tr>
  </thead>
<?php
arsort($stats['source langs']);
foreach($stats['source langs'] as $natlang=>$count) {
  if (!in_array($natlang, OFFICIAL_SOURCE_NATLANGS)) {
    continue;  
  }
  ?>
    <tr><td><?=$natlang?></td><td><?= round($count/$stats['terms count']*100, 1); ?>%</td></tr>
<?}?>
</table>
</section>


<section style="display:flex; flex-direction: column; gap:2em;">


<p><?=$stats['terms count']?> dictionary entries</p>


<!--Word categoy (affix, etc)-->
<table>
  <thead>
    <tr><th>Word Category</th><th>Words</th></tr>
  </thead>
  <tbody>
<?php
foreach($stats['categories'] as $name=>$count) {?>
    <tr><td><?=$name?></td><td><?=$count?></td></tr>
<?}?>
</tbody>
</table>

</section>
</div> <!--/flexy-->

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
