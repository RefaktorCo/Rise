<style>
.parallax-<?php print $node->nid; ?>{
  background:url(<?php echo file_create_url($node->field_parallax_background['und'][0]['uri']); ?>) no-repeat center center fixed;
  
}
</style>

<div class="parallax-<?php print $node->nid; ?> parallax" >
	<div class="tint largepadding">
		<!-- section heading -->
		<section class="row heading">
		<h1><?php print $title; ?></h1>
		</section>
		
		<section class="row dots">
      <?php print render($content['body']); ?>
		</section>
	</div>
</div>