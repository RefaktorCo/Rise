<div id="comments" class="comments <?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

  <?php if ($content['comment_form']): ?>
    <h3 class="bold"><?php print t('Leave a comment'); ?></h3>
    <?php print render($content['comment_form']); ?>
  <?php endif; ?>
</div>