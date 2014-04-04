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
<!-- end header -->

<?php print $messages; ?>

<?php print render($page['content']); ?>

<footer>
	<section class="row heading">
		<!-- section heading -->
		<h4>COME FIND ME</h4>
		<h5 class="eight columns centered grey-text">I am usually cooking something up at one of these social networks. Lets be friends.</h5>
		</section>
		<section class="row">
		<ul class="ring-list">
			<!-- add social media links here -->
			<li><a href="#"><i class="icon-facebook"></i></a></li>
			<li><a href="#"><i class="icon-twitter"></i></a></li>
			<li><a href="#"><i class="icon-dribbble"></i></a></li>
			<li><a href="#"><i class="icon-github"></i></a></li>
			<li><a href="#"><i class="icon-linkedin"></i></a></li>
		</ul>
		</section>
		<!-- copyright -->
		<section class="row copyright">
		<p class="grey-text">
			 © Rise Template 2013. All rights reserved<br>
			 Template by CodeBlvck.
		</p>
	</section>
</footer>