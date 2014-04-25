<?php 
if (render($content['field_parallax_background'])) {
  drupal_add_css(
    '.parallax-'.$node->nid.'{background: url('. file_create_url($node->field_parallax_background['und'][0]['uri']) .');}',
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


<div class="parallax-<?php print $node->nid; ?> parallax-image" data-stellar-background-ratio="0.5">
	<div class="tint largepadding">
		<!-- section heading -->
		<section class="row heading">
		<?php print render($content['field_image']); ?>
		<h1><?php print $title; ?></h1>
		</section>
		
		<section class="row heading">
      <?php print render($content['body']); ?>
		</section>
	</div>
</div>