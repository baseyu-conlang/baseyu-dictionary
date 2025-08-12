<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="dev_dashboard">
Dev Dashboard
<div class="dashboard">

<section>
    <h2>Features</h2>
    <ul>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi', request:$request, text:"Random Word"); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'abeceli-menalari', request:$request, text:'Browse'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'natlang-abeceli', request:$request, text:'Natlang Browse'); ?></li>

        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexilari', request:$request, text:'Tags'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'estatisti-fe-lexiasel', request:$request, text:'Etymology Stats'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports', request:$request, text:'Reports'); ?>
            <ul>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports/changelog', request:$request, text:'Changelog'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports/new-terms', request:$request, text:'New Terms'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports/updated-entries', request:$request, text:'Updated Entries'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports/removed-terms', request:$request, text:'Removed'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'reports/parse', request:$request, text:'Parse Report'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'am-reporte', request:$request, text:'??? am-reporte'); ?></li>
                
            </ul>
            </li>
        
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'estatisti', request:$request, text:'Stats'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'test', request:$request, text:'Dev Dashboard'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'tul', request:$request); ?><ul>
            <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'tul/basatayti', request:$request, text:'Translation Aid'); ?></li>
            <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'tul/ifa-trasharufitul', request:$request, text:'IPA Converter'); ?></li>
            </ul></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'kandidato-lexi?candidate=', request:$request, text:'Candidate Word Check'); ?>
            <ul>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'samaeskri-lexi', request:$request, text:'Homonyms'); ?></li>
                <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'minimum-duaxey', request:$request, text:'Minimum Pairs'); ?></li>
            </ul>
            </li>
    </ul>
</section>


<section>
    <h2>Words</h2>
    <ul>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/bwaw', request:$request, text:'bwaw'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/ente', request:$request, text:'ente'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/haul', request:$request, text:'haul'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/denwatu+hu', request:$request, text:'denwatu+hu'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/hataya', request:$request, text:'hataya'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/ku', request:$request, text:'ku'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/murto', request:$request, text:'murto'); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/basatayti', request:$request, text:'basatayti'); ?></li>
        <!--
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        <li><?= WorldlangDictUtils::makeLink(config:$config, controller:'lexi/', request:$request); ?></li>
        -->
    </ul>
</section>


<section>
    <h2>Dev Report</h2>
    <pre>
<? include_once($config->api2Path.'reports/dev_report.yaml'); ?>
    </pre>
</hr>
    <pre>
<? include_once($config->api2Path.'reports/import_report.yaml'); ?>
    </pre>
</section>


</div><!--div.dashboard-->
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
