<style>
.clients-<?php print $node->nid; ?>{
  background:url(<?php echo file_create_url($node->field_clients_background['und'][0]['uri']); ?>);
  background-attachment:fixed;
  background-size:cover;
}
</style>

<div id="clients" class="clients-<?php print $node->nid; ?>" data-stellar-background-ratio="0.5">
	<div class="tint largepadding">

		<section class="row heading">
			<h2 class="s-bold"><?php print $title; ?></h2>
			<!-- client images row -->
			<div class="ten columns centered clients">
				<?php print render($content['field_client_images']); ?>	
			</div>
		</section>
		
	</div>
</div>