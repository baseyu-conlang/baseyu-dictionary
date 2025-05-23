<?
/**
  * Examples
  */

if (!empty($config->examples_location) and file_exists($config->examples_location.$entry['slug'].'.yaml')) : 
    $examples = yaml_parse_file($config->examples_location.$entry['slug'].'.yaml');
?>
</pre>

<section class="examples">
<h2><?=sprintf($config->getTrans('Example'), "")?></h2>
<!-- <details> -->
    <!-- <summary> -->
<? for($i = 0; $i < min(2, count($examples)); $i++) : ?>
<blockquote>
<? if (is_array($examples[$i])) :?>
    <p><?=$entry['examples'][$i]['text']?></p>
    <? if(isset($entry['examples'][$i]['citation'])): ?><cite>&mdash; <?= $entry['examples'][$i]['citation']; ?></cite><? endif; ?>
<? else: // TODO: Remove  ?>
    <p><?= $examples[$i]; ?></p>
<? endif; ?>
</blockquote>
<? endfor; ?>
<!-- </summary> -->
<? if (false) : // DEBUG ?>
<? foreach($entry['examples'] as $example): ?>
<blockquote>
<? if (is_array($example)) :?>
    <p><?=$example['text']?></p>
    <? if(isset($example['citation'])): ?><cite>&mdash; <?= $example['citation']; ?></cite><? endif; ?>
<? else: // TODO: Remove  ?>
    <p><?=$example?></p>
<? endif; ?>
</blockquote>
<? endforeach; ?>
<? endif; // DEBUG ?>
<!-- </details> -->
</section>

<?
endif;