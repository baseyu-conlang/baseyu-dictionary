<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="features">

<h1><?=$config->getTrans('tools button');?></h1>


<section>
    <header>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'parse', request:$request);?>"><?=$config->getTrans('report parse title');?></a></h2>
    </header>
    <p><?=$config->getTrans('report parse description');?></p>
</section>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
