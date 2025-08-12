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

  <h1><?=$title?></h1>
  <p><?=$headline?></p>

  <hr/>

<? if (!empty($data)): ?>
  <dl>
  <? foreach($data as $datum):
      $last_update = mb_substr($datum['timestamp'], 0, 10, encoding:"UTF-8");
      if ($cur_date !== $last_update) :
        $cur_date = $last_update;
      ?>
        <hr/>
        <h2><?= $cur_date ?></h2>
      <?    
      endif;
      ?>

      <div>
        <dt>
        <? if (isset($defs)):
            $def = $defs[$datum['term']];
            echo(WorldlangDictUtils::makeLink(
                config:$config, request:$request,
                controller:'word', arg:urlencode($datum['term']),
                text:$defs[$datum['term']]['term'])
            );
          else:
            echo("<strong>{$datum['term']}</strong>");
          endif;
          ?>
        </dt>
        <dd>
        <? if (isset($datum['message'])) : echo $datum['message'];
        else: ?>
        <em>(<a href="<?=$config->grammar_url;?>"><?=$defs[$datum['term']]['class'];?></a>)</em>&nbsp;
        <?=$defs[$datum['term']]['translation'];?>
        <? endif; ?>
        </dd>
      </div>
  <? endforeach; ?>
  </dl>
<? endif; ?>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
