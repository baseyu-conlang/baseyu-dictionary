<?php

namespace WorldlangDict;

// TODO: i18n

$cur_date = "";

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="changelog_report">

<h1>Change log</h1>
<p>Updates to the word list.</p>

<table>
<? foreach($data as $cur) { 
  $last_updated = mb_substr($cur['timestamp'], 0, 10, encoding:"UTF-8");
  if ($cur_date !== $last_updated) {
    $cur_date = $last_updated;
  ?>
  <tr>
    <td span="2"><h2><?= $cur_date; ?></h2></td>
    
  </tr>
  <?    
  }
  ?>
  <tr>
    <td><strong><?= $cur['term']; ?></strong><br/><?= $cur['type']; ?></td>
    <td><?= $cur['message']; ?></td>
  </tr>
<? } ?>
</table>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
