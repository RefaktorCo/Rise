<?php

/**
 * @file views-view-list--portfolio-filters.tpl.php
 * Goodnex's list template file for the Portfolio Filters view.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<section id="options" class="row midtoppadding">
	<ul id="filters" class="option-set">
	  <li><a href="" data-filter="*" class="selected"><?php echo t('All'); ?></a></li>
	  <?php foreach ($rows as $id => $row): ?>
	    <?php print $row; ?>
	  <?php endforeach; ?>
	</ul>
</section>