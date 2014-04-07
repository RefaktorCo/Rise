<!-- blog post -->
<div class="blog-post">
	<!-- post image -->
	<?php print render($content['field_image']); ?>
	<!--post info -->
	<div class="post-info">
		<!-- post title -->
		<h2><?php print $title; ?></h2>
		<!-- post meta -->
		<div class="post-meta">
			<span><?php print t('Posted on:'); ?> <?php print format_date($node->created, 'custom', 'M d'); ?></span><span><?php print t('Posted under:');?> <?php print render($content['field_tags']); ?></span>
		</div>
	</div>
	<!-- post content -->
	<div class="post-content">
		<?php print render($content['body']); ?>
	</div>
	<div class="clear">
	</div>
</div>