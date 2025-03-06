<?php
namespace WorldlangDict;

// Create page description metadata
$trans = [];
foreach($entry['trans'][$config->lang] as $trans_group) {
    $trans[] = implode(", ", $trans_group);
}
$trans = implode("; ", $trans);

$page->description = $entry['term'] . ': ' . htmlspecialchars($trans);
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="entry">


    <header>
        <h1><?=$entry['term']?></h1>
<? if (!empty($entry['word class'])): ?>
        <div class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$entry['word class']?></a>)</div>
<? endif; ?>
        &nbsp; <a href="<?=$entry['ipa link']?>"><span class="fa fa-volume-up"></span></a>
    </header>


<?
/**
 * Translation
 */
require_once('views/entry_view_translations.php');


/**
 * Examples
 */

require_once('views/entry_view_examples.php');


/**
 * Synonyms
 */
if (!empty($entry['synonyms'])):
    $trans =  (count($entry['synonyms']) == 1) ? 'synonym sentence' : 'synonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?
        foreach ($entry['synonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                        $config,
                        'lexi/'.$cur,
                        $request
                    );?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$cur;?></a> <?
        endforeach; ?>
    </section>
<? endif; ?>



<?
/**
 * Antonyms
 */
if (!empty($entry['antonyms'])):
    $trans =  (count($entry['antonyms']) == 1) ? 'antonym sentence' : 'antonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?
        foreach ($entry['antonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                        $config,
                        'lexi/'.$cur,
                        $request
                    );?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$cur;?></a> <?
        endforeach; ?>
    </section>
<? endif; ?>



<?
/**
 * Tags
 */
if (!empty($entry['tags'])):
    foreach ($entry['tags'] as $i=>$tag) {
        $entry['tags'][$i] = WorldlangDictUtils::makeLink(
            $config,
            "lexilari/".$tag,
            $request,
            $tag
        );
    } ?>
<section>
    <h2><?=sprintf($config->getTrans('tags links'), ""); ?></h2>
    <?= implode(', ', $entry['tags']); ?>
</section>
<? endif; ?>





<?
/**
 * Etymology
 */
require_once('views/entry_view_etymology.php');
?>



<?
/**
 * Natlang similar words
 */
if (isset($entry['etymology']['natlang similar'])): ?>
<section class="natlang_similar">
    <h2><?= $config->getTrans('entry natlang similar header'); ?>:</h2>
    <?
    $list = &$entry['etymology']['natlang similar'];
    include($config->templatePath . "partials/entry_language_list.php");
    ?>
</section>
<? endif; ?>


<?
/**
 * Derived Words
 */

if (array_key_exists('derived terms', $entry)): ?>
<section class="derived_words">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
            <?
            foreach($entry['derived terms'] as $slug=>$data) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$slug, $request); ?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$data['term'];?></a> <?
            endforeach;

            ?> <span class="hl h1">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
        <dl>
<?
        foreach($entry['derived terms'] as $a_term=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.urlencode($a_term),
                    $request,
                    $data['term']
                );?></dt>
                <dd>
                <? if (isset($data['class'])) : ?>
                    <em>(<a href="<?=$config->grammar_url;?>"><?=$data['class'];?></a>)</em>&nbsp;
                <? endif; ?>
                    <?=$data['trans'][$request->lang];?>
                </dd>
            </div>
        <? endforeach; ?>
        </dl>
    </details>
</section>
<? endif;






/**
 * Rhyming
 */
if (array_key_exists('rhyme', $entry)): 
    if (isset($entry['rhyme exclusions'])) {
        foreach($entry['rhyme exclusions'] as $key=>$ex) {
            $entry['rhyme exclusions'][$key] = '<a href='.WorldlangDictUtils::makeUri($config, 'lexi/'.$ex, $request).' class="hl encap" lang="'.WL_CODE_FULL.'">'.$ex.'</a>';
        }
        $exclusions = implode('/', $entry['rhyme exclusions']);
    } else {
        $exclusions = "";
    }

?>
<section class="rhymes">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('entry rhymes header'), $exclusions);?></h2>:
            <?
            foreach(array_keys($entry['rhyme']) as $slug) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$slug, $request); ?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$entry['rhyme'][$slug]['term'];?></a> <?
            endforeach;

            ?> <span class="hl ">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('entry rhymes header'), $exclusions);?></h2>:
        <dl>
<?
        foreach($entry['rhyme'] as $a_term=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                        $config,
                        'lexi/'.urlencode($a_term),
                        $request,
                        $data['term']
                    );?></dt>
                <dd>
                <? if (isset($data['word class'])) : ?>
                    <em>(<a href="<?=$config->grammar_url;?>"><?=$data['word class'];?></a>)</em>&nbsp;
                <? endif; ?>
                    <?=$data[$request->lang];?> 
                </dd>
            </div>
        <? endforeach; ?>
        </dl>
    </details>
</section>
<? endif; ?>





<?
/**
 * Entry footer
 */ ?>
<footer>
    <?=WorldlangDictUtils::makeLink($config, 'lexi/'.$entry['term'], $request,
        '<span class="fa fa-link"></span> '.$config->getTrans('Word Link')) ?>
</footer>

</main>



<? 

require_once('views/entry_view_debug.php');

require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
