<?

namespace WorldlangDict;


?>
<ul class="lang_list">
<?
$lstart = true;
foreach($list as $lang=>$example):
    ?>
    <li><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:"natlang-search", arg:$lang, request:$request); ?>" class="hl encap"><?= $lang; ?></a><?
    if (!empty($example)) :
        ?> <span><?=$example?></span><?
    endif;
    ?></li>
<?
endforeach;
?>
</ul>
