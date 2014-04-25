<!-- service -->
<div class="four columns service">
  <?php if (render($content['field_skills_icon'])): ?>
	<div class="icon">
		<?php print render($content['field_skills_icon']); ?>
	</div>
	<?php endif; ?>	
	<!-- service info -->
	<h5 class="s-bold"><?php print $title; ?></h5>
	<p>
	<?php
    $teaser = strip_tags(render($content['body']));
    echo substr($teaser, 0, 100)."...";
  ?>
	</p>
	
	<!-- read more button -->
	<div class="modal-button">
		<a href="#" data-trigger="#modal_<?php print $node->nid; ?>" class="rise-btn small outline dark centered switch">read more</a>
		
	</div>
</div>
	
<!-- service 2 modal direction -->
<div class="srvc">
	<div  id="modal_<?php print $node->nid; ?>" class="modal">
		<div class="content white">
			<!-- we use gumby-trigger to close modal with id#direction
				your can have as many models as your choose just use different ids -->
			<a class="close switch active" data-trigger="|#modal_<?php print $node->nid; ?>"><i class="fa fa-times black-text"></i></a>
			<div class="row">
				<div class="modal-label">
					<h6 class="small-radius s-bold"><?php print t('SKILLS AND SERVICES'); ?></h6>
				</div>
				<!-- content side -->
				<div class="eight columns alpha smalltoppadding">
					<div class="heading left-text">
						<h2><?php print $title; ?></h2>
					</div>
					<?php print render($content['body']); ?>
				</div>
				<?php if (render($content['field_skills_icon'])): ?>
				<!-- service icon -->
				<div class="four columns">
					<div class="large-icon">
						<?php print render($content['field_skills_icon']); ?>
					</div>
				</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</div>
<!-- end service 2 modal -->	