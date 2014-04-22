<div id="contact">
	<div class="white">
	
		<!-- section heading -->
		<section class="row heading">
		  <h3><?php print $title; ?></h3>
		  <h2 class="ten columns centered"><?php print strip_tags(render($content['field_contact_caption'])); ?></h2>
		</section>
		
		<section class="row bigtoppadding">
			<!-- begin form -->
			<div class="eight columns centered">

				<?php 	
				  if (module_exists('contact')) {
					  require_once drupal_get_path('module', 'contact') .'/contact.pages.inc'; 
					  $contact_form = drupal_get_form('contact_site_form');
					  print drupal_render($contact_form); 
				  }
				?>  

		  </div>
		</section>
		
	</div>
</div>		