<?php if ($element['#view_mode']=="teaser") { ?> 
<?php print render($items[0]); ?>
<?php } else { ?> 
<?php foreach ($items as $delta => $item): ?>
  <div class="two columns"><?php print render($item); ?></div>
<?php endforeach; ?>
<?php } ?> 