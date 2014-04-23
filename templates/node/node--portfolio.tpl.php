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
<div class="clear"></div>