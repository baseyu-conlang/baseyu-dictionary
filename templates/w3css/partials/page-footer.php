<?php
namespace WorldlangDict;
?>


<footer id="siteFooter" class="">
    <section class="langs">
        <?php
        $firstLang = true;
        foreach($config->userLangs as $curLang=>$curName) {
            $uri = WorldlangDictUtils::changeLangUri($config, $request, $curLang);
            if (!$firstLang) echo " &bull; ";
            else $firstLang = false;
            echo "<a href=\"{$uri}\">{$curName}</a>";
        } ?>
    </section>

    <section class="about">
        <!-- TODO: add alt text to i18n -->
            <img src="<?= $config->site_logo_url; ?>" height="64" width="64" alt="<?= $config->getTrans('site_name_short'); ?> Logo" />
            <p><?= $config->getTrans('site_name_full'); ?><br/>
            <em><?= $config->getTrans('site_slogan'); ?></em></p>
    </section>

    <section><ul>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'abeceli-menalari', $request); ?>"><?= $config->getTrans('browse title') ?></a></li>
        <li><a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?php echo $config->getTrans('word classes link');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'estatisti-fe-lexiasel', $request); ?>"><?php echo $config->getTrans('natlangs title');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexi', $request); ?>"><?php echo $config->getTrans('random word button');?></a></li>
<? if ($request->lang === 'eng') : ?>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a></li>
<? endif; ?>
    </ul></section>
    
    <!-- Additional links -->
    <section><ul>
        <li><a href="https://globasa.net/<?=$request->lang;?>/">🔗 Globasa</a></li>
        <li><a href="https://xwexi.globasa.net/<?=$request->lang;?>/">🔰 Xwexi</a></li>
        <li><a href="https://doxo.globasa.net/<?=$request->lang;?>/">📖 Doxo</a></li>
        <li><a href="https://menalari.globasa.net/<?=$request->lang;?>/">📔 Menalari</a></li>
    </ul></section>

    <!-- Software links -->
    <section><ul>
        <li><a href="<?php echo WorldlangDictUtils::makeUri(
                    $config,
                    'am-reporte/?url='.$config->siteUri.substr($request->url, 1),
                    $request
                ); ?>"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a></li>
        <li><a href="https://github.com/PartialShawn/worldlang-dictionary"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a></li>
        <li><a href="https://github.com/Globasa-Team/globasa-docs"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a></li>
    </ul></section>

    <section class="copyright">  
        <a xmlns:dct="http://purl.org/dc/terms/" rel="license" class="cc_license badge"
            href="http://creativecommons.org/publicdomain/zero/1.0/">
            <img src="https://cdn.globasa.net/graphics/site_graphics/cc_blue_x2.png" alt="CC0" class="cc_license"/>
            <img src="https://cdn.globasa.net/graphics/site_graphics/cc_zero_blue_x2.png" alt="CC0" class="cc_license"/>
        </a>
        <p xmlns:dct="http://purl.org/dc/terms/" class="cc_license">
            To the extent possible under law, <a rel="dct:publisher" href="https://globasa.net/"><span property="dct:title"><?= $config->getTrans('site_owner'); ?></span></a> has waived all copyright and related or neighboring rights to this site content. Built on a <a href="https://partialsolution.ca" rel="nofollow">Partial Solution</a>.
        </p>
    </section>

</footer>