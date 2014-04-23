<div class="white">		
	<section class="row heading">
	<!-- section heading -->
	<h3><?php print $title; ?></h3>
	<h2 class="ten columns centered s-bold"><?php print strip_tags(render($content['field_about_headline']));?></h2>
	</section>
	
	<section class="row midtoppadding">
	<div class="ten columns centered">
		<div class="six columns">
			<!-- profile picture -->
			<img src="<?php echo file_create_url($node->field_about_image['und'][0]['uri']); ?>" class="profile_pic" alt="profile pic"/>
			<!-- italic text -->
			<div class="eight columns centered">
				<h5 class="s-bold italic grey-text center"><?php print strip_tags(render($content['field_about_image_quote']));?></h5>
			</div>
		</div>
		<!-- about info -->
		<div class="six columns about-text">
			<?php print render($content['body']); ?>
			<!-- button -->
			<a href="<?php print strip_tags(render($content['field_about_link']));?>" class="target rise-btn dark pull_right"><?php print t('VIEW MY WORK'); ?></a>
		</div>
	</div>
	</section>
</div>