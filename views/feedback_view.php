<?php namespace WorldlangDict; ?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>

<header>
  <h2><?=$config->getTrans('feedback title');?></h2>
</header>

<form
  action="https://formspree.io/maylyonr"
  method="POST"
>
  <input type="hidden" name="URL" value="<?=isset($request->options['url'])?$request->options['url']:'(blank)';?>" >
  <label>
    <p><?=$config->getTrans('email?');?></p>
    <input type="text" name="_replyto">
  </label>

  <p><?=$config->getTrans('subject?');?></p>
  <label><input type="radio" name="subject" value="<?=$config->getTrans('feedback site error');?>" checked>
  <?=$config->getTrans('feedback site error');?></label><br/>

  <label><input type="radio" name="subject" value="<?=$config->getTrans('feedback lang sug');?>">
  <?=$config->getTrans('feedback lang sug');?></label><br/>

  <label><inputtype="radio" name="subject" value="<?=$config->getTrans('feedback other');?>">
  <?=$config->getTrans('feedback other');?></label><br/>

  <label>
    <p><?=$config->getTrans('message?');?></p>
    <textarea name="message"></textarea>
  </label>

  <div class="feedbackSubmit">
    <button type="submit"><?=$config->getTrans('feedback send button');?></button>
  </div>
</form>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
