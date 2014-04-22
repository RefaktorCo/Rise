<style>
.clients-image{
  background:url(<?php echo file_create_url($node->field_client_background_image['und'][0]['uri']); ?>);
  background-attachment:fixed;
  background-size:cover;
}
</style>

<section class="row heading">
	<h2 class="s-bold"><?php print $title; ?></h2>
	<!-- client images row -->
	<div class="ten columns centered clients">
		<?php print render($content['field_client_images']); ?>	
	</div>
</section>