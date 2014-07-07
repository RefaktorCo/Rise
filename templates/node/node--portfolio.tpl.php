<div class="ajax-nav-mobile mobile-pagination">
  <ul>	
	<?php if ( rise_node_pagination($node, 'p') != NULL ) : ?>
	  <li class="prevProject-mobile"><a href="#!node/<?php print rise_node_pagination($node, 'p'); ?>"><i class="fa fa-chevron-left"></i></a></li>
  <?php endif; ?>  
  
  <?php if ( rise_node_pagination($node, 'n') != NULL ) : ?>
	  <li class="nextProject-mobile"><a href="#!node/<?php print rise_node_pagination($node, 'n'); ?>"><i class="fa fa-chevron-right"></i></a></li>
	<?php endif; ?>  				
	</ul>
</div>

<section class="row heading left-text">
	<!-- project index and specs -->
	<?php if (render($content['field_portfolio_category'])): ?>
	<div class="bigbottompadding">
		<ul class="project-spec">
			<li class="index"><?php print t('CATEGORY:'); ?></li>
			<?php print str_replace(', ', ' ', render($content['field_portfolio_category'])); ?>
		</ul>
	</div>
	<?php endif; ?>
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
			  <li class="prevProject"><a href="#!node/<?php print rise_node_pagination($node, 'p'); ?>"><i class="fa fa-chevron-left"></i></a></li>
		  <?php endif; ?>  
		  <?php if ( rise_node_pagination($node, 'n') != NULL ) : ?>
			  <li class="nextProject"><a href="#!node/<?php print rise_node_pagination($node, 'n'); ?>"><i class="fa fa-chevron-right"></i></a></li>
			<?php endif; ?>  
		</ul>
	</section>
</div>
<!-- END PROJECT NAVIGATION AND CLOSE BUTTON -->
<div class="clear"></div>

