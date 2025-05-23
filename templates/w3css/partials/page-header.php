<?php
namespace WorldlangDict;
?>

<div id="siteHeader">
    <p id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'', request:$request); ?>">
        <img src="<?= $config->site_logo_url; ?>" height="28" width="28" alt="<?= $config->getTrans('site_name_short'); ?> Logo" />
        <?php echo $config->getTrans('site_name_short'); ?>
        </a>
    </p>
    <nav>
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'browse', request:$request); ?>"><?= $config->getTrans('browse title') ?></a> &bull;
        <a href="<?=$config->grammar_url;?>"><?php echo $config->getTrans('word classes link');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'tag', request:$request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'tool', arg:'basatayti', request:$request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'natlang', request:$request); ?>"><?php echo $config->getTrans('natlangs title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'word', request:$request); ?>"><?php echo $config->getTrans('random word button');?></a>
<? if ($request->lang === 'eng') : ?>
        &bull; <a href="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:'tool', request:$request); ?>"><?php echo $config->getTrans('tools button');?></a>
<? endif; ?>
    </nav>
    <section class="search">
        <form action="<?php echo WorldlangDictUtils::makeUri(config:$config, controller:"search", request:$request); ?>" method="get">
            <input type="text" name="<?= WL_CODE_SHORT; ?>" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" value="" />
            <input type="text" name="<?=$request->lang; ?>" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" value="" />
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" />
        </form>
    </section>


</div>
