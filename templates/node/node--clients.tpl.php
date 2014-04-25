<?php 
if (render($content['field_client_background_image'])) {
  drupal_add_css(
    '.clients-image {background: url('. file_create_url($node->field_client_background_image['und'][0]['uri']) .');}',
    array(
      'group' => CSS_THEME,
      'type' => 'inline',
      'media' => 'screen',
      'preprocess' => FALSE,
      'weight' => '9999',
    )
  );
}
?>


<section class="row heading">
	<h2 class="s-bold"><?php print $title; ?></h2>
	<!-- client images row -->
	<div class="ten columns centered clients">
		<?php print render($content['field_client_images']); ?>	
	</div>
</section>