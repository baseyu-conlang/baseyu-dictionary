<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>
<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlang_browse">

<h1><?=$config->getTrans('natlang browser title');?></h1>


<dl>
<? foreach($index as $term=>$data) :
$first = true;
//   if (!in_array($natlang, OFFICIAL_NATLANGS)) {
//     continue;  
//   }
    ?>
    <div><dt><?= $term; ?>:</dt><dd> <? foreach($data as $trans) :
    if (!$first) {
        echo ", ";
    }
    echo WorldlangDictUtils::makeLink(config:$config, controller:'word', arg:$trans, request:$request, text:$trans);
    $first = false;
    endforeach; ?></dd></div>
<? endforeach; ?>
</dl>



</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
