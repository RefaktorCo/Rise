<li class="grid-item <?php print str_replace('&amp;', 'and', str_replace(',-', ' ', str_replace(' ', '-',strip_tags(render($content['field_portfolio_category']))))); ?>">
	<div class="grid-project">
		<!-- ajax link -->
		<a href="#!node/<?php print $node->nid; ?>/" class="open-slide">
		<!-- project image -->
		<div class="img-box">
			<?php print render($content['field_portfolio_image']); ?>
		</div>
		<!-- project title and category -->
		<div class="project-info">
			<h1><?php print $title; ?></h1>
			<h6><?php print str_replace(', ', ' & ',strip_tags(render($content['field_portfolio_category']))); ?></h6>
		</div>
		</a>
	</div>
</li>