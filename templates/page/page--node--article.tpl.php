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
  <section class="row">		
	  <?php print $messages; ?>
	  
	  <?php if ($tabs = render($tabs)): ?>
		  <div id="drupal_tabs" class="tabs ">
		    <?php print render($tabs); ?>
		  </div>
		<?php endif; ?>
		<?php print render($page['help']); ?>
		<?php if ($action_links): ?>
		  <ul class="action-links">
		    <?php print render($action_links); ?>
		  </ul>
		<?php endif; ?>

	  <?php print render($page['content']); ?>
  </section>
</div>

<?php print render($page['after_content']); ?>

<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>