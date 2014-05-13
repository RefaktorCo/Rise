<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<!-- mobile ajax section -->
<div class="ajax-section white">
	<div class="clearfix">
		<!-- PROJECT NAVIGATION AND CLOSE BUTTON -->
		<section class="row">
			<div class="ajax-nav-mobile">
				<ul>
					<li class="closeProject-mobile"><a href="#"><i class="fa fa-times"></i></a></li>
				</ul>
			</div>
		  <!-- END PROJECT NAVIGATION AND CLOSE BUTTON -->
		</section>
		<div class="loader"></div>
		<!-- PROJECT WILL LOSE INSIDE 'AJAX-INSIDE' -->
		<div class="ajax-outside">
			<div class="ajax-inside-mobile"></div>
		</div>
		<!-- END AJAX CONTENT -->
	</div>
	<!-- END AJAX SECTION -->
	<div class="clear"></div>
</div>
<!-- end mobile ajax section -->
<div class="clear"></div>
<!-- begin intro-->
<div class="white">

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <section class="row heading">
      <?php print $header; ?>
    </section>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
  <section class="row midtoppadding">
    <!-- begin projects -->
	  <ul class="grid" id="projects">
      <?php print $rows; ?>
	  </ul>
  </section>  
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>
<?php /* class view */ ?>
</div>