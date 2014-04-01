<!-- service -->
<div class="four columns service">
  <?php if render($content['field_skills_image']): ?>
	<div class="icon">
		<!-- you can replace below gif image with fontawesome icon -->
		<img src="<?php echo file_create_url($node->field_skills_image['und'][0]['uri']); ?>" class="gif-icon" alt="iconnn"/>
	</div>
	<?php endif; ?>	
	<!-- service info -->
	<?php
    $teaser = strip_tags(render($content['body']));
    echo substr($teaser, 0, 100)."...";
  ?>
	<!-- read more button -->
	
	<div class="modal-button no-mobile">
		<a href="#" gumby-trigger="#modal_<?php print $node->nid; ?>" class="rise-btn small outline dark centered switch">read more</a>
		
	</div>
</div>
	
<!-- service 2 modal direction -->
<div class="srvc">
	<div  id="modal_<?php print $node->nid; ?>" class="modal">
		<div class="content white">
			<!-- we use gumby-trigger to close modal with id#direction
				your can have as many models as your choose just use different ids -->
			<a class="close switch active" gumby-trigger="|#direction"><i class="icon-remove black-text"></i></a>
			<div class="row">
				<div class="modal-label">
					<h6 class="small-radius s-bold">SKILLS AND SERVICES</h6>
				</div>
				<!-- content side -->
				<div class="eight columns alpha smalltoppadding">
					<div class="heading left-text">
						<h2><?php print $title; ?></h2>
					</div>
					<?php print render($content['body']); ?>
				</div>
				<?php if render($content['field_skills_icon']): ?>
				<!-- service icon -->
				<div class="four columns">
					<div class="large-icon">
						<?php strip_tags(render($content['field_skills_icon'])); ?>
					</div>
				</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</div>
<!-- end service 2 modal -->	