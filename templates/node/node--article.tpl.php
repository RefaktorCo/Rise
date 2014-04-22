<section class="row">
  <div class="ten columns centered">
		<!-- blog post -->
		<div class="blog-post">
			<!-- post image -->
			<?php print render($content['field_image']); ?>
			
			<!-- Before Title -->
			<?php print render($content['field_before_title']); ?>
			<!--post info -->
			<div class="post-info">
				<!-- post title -->
				<h2><?php print $title; ?></h2>
				<!-- post meta -->
				<div class="post-meta">
					<span><?php print t('Posted on:'); ?> <?php print format_date($node->created, 'custom', 'F d, Y'); ?></span><span><?php print t('Posted under:');?> <?php print render($content['field_tags']); ?></span>
				</div>
			</div>
			<!-- post content -->
			<div class="post-content">
				<?php print render($content['body']); ?>
			</div>
			<div class="clear">
			</div>
			<?php
		    // Remove the "Add new comment" link on the teaser page or if the comment
		    // form is being displayed on the same page.
		    if ($teaser || !empty($content['comments']['comment_form'])) {
		      unset($content['links']['comment']['#links']['comment-add']);
		    }
		    // Only display the wrapper div if there are links.
		    $links = render($content['links']);
		    if ($links):
		  ?>
		    <div class="link-wrapper">
		      <?php hide($content['links']); ?>
		      <a href="<?php print $node_url; ?>" class="rise-btn dark small pull_right"><i class="icon-chevron-right"></i> &nbsp;<?php print t('read more'); ?></a>
		    </div>
		  <?php endif; ?>
		  <div class="clear"></div>
		</div>
  </div>
</section>
<!-- end blog post row -->
<?php if(!$teaser): ?>
<!-- pagination -->
<section class="row">
<ul class="post-nav">
  <?php if ( rise_node_pagination($node, 'p') != NULL ) : ?>
	  <li><a href="<?php print url('node/' . rise_node_pagination($node, 'p'), array('absolute' => TRUE)); ?>"><i class="icon-chevron-left"></i></a></li>
  <?php endif; ?>  
	<li><a href="../"><i class="icon-list"></i></a></li>
	<?php if ( rise_node_pagination($node, 'n') != NULL ) : ?>
	  <li><a href="<?php print url('node/' . rise_node_pagination($node, 'n'), array('absolute' => TRUE)); ?>"><i class="icon-chevron-right"></i></a></li>
	<?php endif; ?>  
</ul>
</section>
<?php endif; ?>  
<!-- end blog grey -->
<?php if (render($content['comments'])): ?>
<section class="row">
  <div class="ten columns centered">
    <h3 class="bold"><?php print $comment_count; ?> <?php print t('Comments'); ?></h3>
    <?php print render($content['comments']); ?>
  </div>
</section>
<?php endif; ?>