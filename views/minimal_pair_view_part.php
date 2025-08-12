<?php
namespace WorldlangDict;
?>

    <h1><?=$config->getTrans('minimum pair title');?></h1>
    <p><?=$config->getTrans('minimum pair description');?></p>
<?    
if (isset($request->options['candidate'])) {
    $candidate = $request->options['candidate'];
} else {
    $candidate = '';
}

if ($page->show_input): ?>
    <form class="tool" action="<?=WorldlangDictUtils::makeUri(config:$config, controller:'tool', arg:'minimum-duaxey', request:$request);?>" method="get" accept-charset="utf-8">
        <input type="text" name="candidate" placeholder="<?=$config->getTrans('minimum pair new placeholder');?>" value="<?=$candidate;?>" />
        <input type="submit" value="<?=$config->getTrans('minimum pair new button');?>" />
    </form>
<? endif;

$searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
$d[0] = '';
$d[1] = '';
$d[2] = '';

foreach ($pairs as $word=>$data) {
    foreach ($data as $match=>$distance) {
        $d[$distance] .= '<li>'.$word.': '. $match.'</li>';
    }
}

?>

    <h2><?=sprintf($config->getTrans('minimum pair result diff'), '1');?></h2>
    <? if (empty($d[1])) : 
        $page->content .= $config->getTrans("none found");
    endif; ?>
    <ul><?=$d[1];?></ul>

    <h2><?=sprintf($config->getTrans('minimum pair result diff'), '2');?></h2>
    <? if (empty($d[2])):
        $page->content .= $config->getTrans("none found");
    endif; ?>
    <ul><?=$d[2]?></ul>