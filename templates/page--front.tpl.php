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
		
		<!-- link to your section ids -->
		<!-- we use href attribute for li active class to work on different sections.
		   we use gumby-goto for easing scroll to target sections -->
		<ul class="navigation">
			<li><a href="#intro" class="skip" gumby-goto="#intro" gumby-duration="800" gumby-offset="-50" gumby-update>HOME</a></li>
			<li><a href="#services" class="skip" gumby-goto="#services" gumby-duration="800" gumby-offset="-50"  gumby-update>SERVICES</a></li>
			<li><a href="#about" class="skip" gumby-goto="#about" gumby-duration="800" gumby-offset="-50"  gumby-update>ABOUT</a></li>
			<li><a href="#method" class="skip" gumby-goto="#method" gumby-duration="800" gumby-update>METHOD</a></li>
			<li><a href="#work" class="skip" gumby-goto="#work" gumby-duration="800" gumby-offset="-50" gumby-update>WORK</a></li>
			<li><a href="#contact" class="skip" gumby-goto="#contact" gumby-duration="800" gumby-offset="-50"  gumby-update>CONTACT</a></li>
			<li><a href="blog.html">BLOG</a></li>
			<li><a href="features.html">FEATURES</a></li>
		</ul>
	</div>
</div>

</header>
<!-- end header -->
<div style="height: 100px;"></div>
<?php print $messages; ?>
<?php print render($page['content']); ?>

