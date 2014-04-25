<?php if (theme_get_setting('loader') == 1): ?>
<!-- Preloader -->
<div id="preloader">
	<div id="status">
		&nbsp;
	</div>
</div>
<?php endif; ?>

<!-- header -->
<header>
<div class="row navbar">
	<!-- logo -->
	<div class="three columns logo">
		<?php if ($logo): ?>
		<div id="logo">
			<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
	      <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
	    </a>
		</div>
	  <?php endif; ?>
	</div>
	<!-- navigation -->
	<div class="nine columns" id="nav">
		<div class="nav-button">
			<a class="white-text"><i class="fa fa-bars"></i></a>
		</div>
		<?php print render($page['site_navigation']); ?>
	</div>
</div>

</header>
<!-- end header -->
<?php print render($page['before_content']); ?>
<?php print render($page['front_content']); ?>
<?php print render($page['after_content']); ?>
<?php print $messages; ?>
<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>

<!-- PROJECT DETAILS CONTAINER -->
<div id="portfolio-detail">
	<div class="loading-screen">
		<div class="logo">
			<!-- add your logo link -->
			<img src="<?php print $logo; ?>" alt="logo">
		</div>
	</div>
	<div class="ajax-section">
		<div class="clearfix">
			<!-- PROJECT NAVIGATION AND CLOSE BUTTON -->
			<div class="ajax-nav">
				<section class="row">
				<ul class="project-nav">
					<li class="closeProject"><a href="<?php global $base_url; echo $base_url; ?>#"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- END PROJECT NAVIGATION AND CLOSE BUTTON -->
				</section>
			</div>
			<div class="loader">
			</div>
			<!-- PROJECT WILL LOAD INSIDE 'AJAX-INSIDE' -->
			<div class="ajax-box">
				<div id="ajax-outside">
					<div id="ajax-inside">
					</div>
				</div>
			</div>
			<!-- END AJAX SECTION -->
			<div class="clear">
			</div>
		</div>
	</div>
	<!-- end ajax section -->
</div>

<!-- end portfolio detail -->
<?php if (theme_get_setting('loader') == 1): ?>
<!-- loader -->
<script type="text/javascript">
//<![CDATA[
  jQuery(document).ready(function ($) {
  $(window).load(function() { // makes sure the whole site is loaded
    $("#status").fadeOut(); // will first fade out the loading animation
    $("#preloader").delay(350).fadeOut("slow"); // will fade out the grey DIV that covers the website.      
})});
//]]>
</script>
<?php endif; ?>