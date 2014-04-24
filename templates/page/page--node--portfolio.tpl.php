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

<div id="ajaxpage">
  <div class="white">
		<?php if ($messages): ?>
		  <section class="row">
		    <?php print $messages; ?>
		  </section>  
		<?php endif; ?>
		<?php if ($tabs = render($tabs)): ?>
		  <section class="row">
			  <div id="drupal_tabs" class="tabs ">
			    <?php print render($tabs); ?>
			  </div>
		  </section>
		<?php endif; ?>
		<?php print render($page['help']); ?>
		<?php if ($action_links): ?>
		  <ul class="action-links">
		    <?php print render($action_links); ?>
		  </ul>
		<?php endif; ?>
		<?php print render($page['content']); ?>
	</div>
</div>

<?php print render($page['after_content']); ?>
		
<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>