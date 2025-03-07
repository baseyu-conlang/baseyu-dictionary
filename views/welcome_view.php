<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body class="welcome">


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>
  <img src="<?=$config->site_logo_url;?>" />
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>