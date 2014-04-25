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
<div class="white">
<?php if ($title): ?>
<section class="row bigtoppadding heading">
	<h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
</section>
<?php endif; ?>
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
</section>
<section class="row">

  <?php if ( ($page['sidebar_left']) ) : ?>
    <aside id="sidebar-left">
		  <div class="<?php if ($page['sidebar_right']) { echo "three columns";} else { echo "four columns"; } ?>">
		    <?php print render($page['sidebar_left']); ?>
		  </div>
	  </aside>  
  <?php endif; ?>
  
  <div class="<?php if ( ($page['sidebar_right']) AND ($page['sidebar_left']) ) { echo "six columns";} elseif ( ($page['sidebar_right']) OR ($page['sidebar_left']) ) {  echo "eight columns"; }  else { echo "twelve columns"; } ?>">
    <?php print render($page['content']); ?>
  </div>
  
  <?php if ( ($page['sidebar_right']) ) : ?>
    <aside id="sidebar-right">
		   <div class="<?php if ($page['sidebar_left']) { echo "three columns";} else { echo "four columns"; } ?>">
		    <?php print render($page['sidebar_right']); ?>
		  </div>
	  </aside>  
  <?php endif; ?>
  
</section>
</div>
<?php if (render($page['footer'])): ?>
<footer>
  <?php print render($page['footer']); ?>
</footer>
<?php endif; ?>