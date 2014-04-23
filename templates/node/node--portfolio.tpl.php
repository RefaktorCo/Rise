<section class="row heading left-text">
	<!-- project index and specs -->
	<div class="bigbottompadding">
		<ul class="project-spec">
			<li class="index"><?php print t('CATEGORY:'); ?></li>
			<?php print render($content['field_portfolio_category']); ?>
		</ul>
	</div>
	<!-- project title -->
	<h2 class="bold"><?php print $title; ?></h2>
	<!-- project detail -->
	<div class="ten columns alpha project-text">
	  <?php print render($content['body']); ?>
	</div>
</section>
<section class="row bigtoppadding">
	<!-- project slides -->
	<div class="twelve columns">
		<div class="flexslider">
		  <ul class="slides">
			  <?php print render($content['field_portfolio_image']); ?>
		  </ul>
		</div>
	</div>
</section>
<!-- PROJECT NAVIGATION AND CLOSE BUTTON -->
<div class="ajax-nav">
  <section class="row">
		<ul class="project-nav">
		  <?php if ( rise_node_pagination($node, 'p') != NULL ) : ?>
			  <li class="prevProject"><a href="#!node/<?php print rise_node_pagination($node, 'p'); ?>"><i class="icon-chevron-left"></i></a></li>
		  <?php endif; ?>  
		  <?php if ( rise_node_pagination($node, 'n') != NULL ) : ?>
			  <li class="nextProject"><a href="#!node/<?php print rise_node_pagination($node, 'n'); ?>"><i class="icon-chevron-right"></i></a></li>
			<?php endif; ?>  
		</ul>
	</section>
</div>
<!-- END PROJECT NAVIGATION AND CLOSE BUTTON -->
<div class="clear"></div>

