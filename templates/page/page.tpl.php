<!-- header -->
<header>
<div class="row">
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
		<?php print render($page['site_navigation']); ?>
	</div>
</div>

</header>
<!-- end header -->
<div class="white">
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
<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>