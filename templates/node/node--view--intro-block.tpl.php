<!-- intro text goes here -->
<section class="row intro-text">
<h1><?php print strip_tags(render($content['field_intro_headline']));?></h1>

<?php print render($content['field_intro_content']);?></section>
<!-- down arrow -->
<div class="down-arrow">
	<a href="#about" class="target"><i class="icon-chevron-down"></i></a>
</div>

<script type="text/javascript">
jQuery(document).ready(function ($) {

var options = { videoId: "<?php print strip_tags(render($content['field_intro_video_background']));?>", start: 12 };
	$('#intro').tubular(options);		    });
  
</script>
