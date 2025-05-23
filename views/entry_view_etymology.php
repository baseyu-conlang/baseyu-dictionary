<?;

namespace WorldlangDict;

if (!(empty($entry['etymology']))):
?>
<section class="etymology">
<h2><?= sprintf($config->getTrans('Etymology'), "")?></h2>
<?

// A priori
if (!empty($entry['etymology']['a priori'])): ?>
    <p class="apriori"><em><?= $config->getTrans('entry etymology a priori text'); ?></em></p>
<? endif;



// Derived
if (isset($entry['etymology']['derived trans'])): ?>
<div class="derived">
    
    <?
foreach($entry['etymology']['derived trans'] as $data) :
    if (isset($data['slug'])) :
        ?><a href="../lexi/<?= $data['slug']; ?>"><?= $data['text']; ?></a><?
    elseif ($data['text'] === ',') :
        ?>, <?
    else :
        echo(' '.$data['text'].' ');
    endif;
endforeach;
?>
    <dl>
<? foreach($entry['etymology']['derived trans'] as $data) :
    if (isset($data['trans'])) : ?>
        <div>
        <dt><?=WorldlangDictUtils::makeLink(text:$data['text'],
                    config:$config, request:$request,
                    controller:'word', arg:$data['text'],
                );?></dt>
        <dd>
        <? if (isset($data['word class'])) : ?>
            <em>(<a href="<?=$config->grammar_url;?>"><?=$data['word class'];?></a>)</em>&nbsp;
        <? endif; ?>
            <?=$data['trans'][$request->lang];?>
        </dd>
        </div>
        
        <?
    endif;
endforeach; ?>
    </dl>
</div>
<? endif;



// Natlang
if (isset($entry['etymology']['natlang'])): ?>
<div class="natlang">
<?
    $list = &$entry['etymology']['natlang'];
    include($config->templatePath . "partials/entry_language_list.php");
?>
</div>
<? endif; ?>

<?
// am oko
if (isset($entry['etymology']['am oko'])): ?>
<div class="am_oko">
    <h3><?= $config->getTrans('entry etymology am oko header'); ?></h3>
    <ul>
    <? foreach($entry['etymology']['am oko'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>.
</div>
<? endif;




// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
<div class="kwasilexi">
    <h3><?= $config->getTrans('entry etymology kwasilexi header'); ?></h3>:
    <? $list = &$entry['etymology']['kwasilexi'];
    include($config->templatePath . "partials/entry_language_list.php"); ?>
</div>
<? endif;


// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
<div>
    <h3><?= $config->getTrans('entry etymology am kompara header'); ?></h3>:
    <ul>
    <? foreach($entry['etymology']['am kompara'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;


// link
if (isset($entry['etymology']['link'])): ?>
<p><?= $config->getTrans('entry etymology link') ?><br/>
<a href="<?=$entry['etymology']['link']?>"><?=$entry['etymology']['link']?></a></p>
<? endif; ?>

</section>

<? endif; /* !empty($entry['etymology']) */ ?>