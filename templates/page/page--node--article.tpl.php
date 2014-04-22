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
			<a class="white-text"><i class="icon-reorder"></i></a>
		</div>
		
		<!-- link to your section ids -->
		<!-- we use href attribute for li active class to work on different sections.
		   we use gumby-goto for easing scroll to target sections -->
		<?php print render($page['site_navigation']); ?>
	</div>
</div>

</header>
<?php print render($page['before_content']); ?>

<!-- end header -->
<?php if ((render($page['blog_menu_left'])) OR (render($page['blog_menu_right']))): ?>
<!-- blog menu -->
<div class="blog-menu">
	<section class="row">
	<!-- blog categories -->
	<div class="eight columns">
		<?php print render($page['blog_menu_left']); ?>
	</div>
	<!-- blog search -->
	<div class="four columns">
		<?php print render($page['blog_menu_right']); ?>
	</div>
	</section>
</div>
<!-- end blog menu -->
<?php endif; ?>


<div id="blog" class="grey">
  <?php print $messages; ?>
  <?php print render($page['content']); ?>
</div>

<?php print render($page['after_content']); ?>

<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>
