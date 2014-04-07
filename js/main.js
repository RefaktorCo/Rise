jQuery(document).ready(function ($) {

/* intro text slider initialize
	=========================*/
	$('.intro-text-slider').flexslider({
		animation: "fade",
		slideshow: true,
		controlNav: false,
		directionNav: false, 
		easing: "easeOutExpo",
		slideshowSpeed: 2000 
		
	});
	
	$('.flexslider').flexslider({
    animationLoop: true,
    pauseOnAction: true,
    pauseOnHover: true,
    smoothHeight: false,
    directionNav: true,
    controlNav: true,
    animation: "slide"
  });
  
  /* smooth linking
	=========================*/
	$('.target').on(Gumby.click, function() {
	 var href = $(this).attr("href"),
	 topMenu = $(".navigation"),
		topMenuHeight = topMenu.outerHeight()+15,
		  offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
	  $('html, body').stop().animate({ 
		  scrollTop: offsetTop
	  }, 800, 'easeOutExpo');
	  e.preventDefault();
	});
  
  /* gif animations
	=========================*/
	var animations = {

	  init: function(){
		// Service Gifs
		$('.service').on('mouseenter', function(e){
		  var el = $(this).find('.gif-icon');
		  var src = el.attr('src');
		  el.attr('src', src.replace('.gif', '_anim.gif'));
		});

		$('.service').on('mouseleave', function(e){
		  var el = $(this).find('.gif-icon');
		  var src = el.attr('src');
		  el.attr('src', src.replace('_anim.gif', '.gif'));
		});
	  }
	}
	animations.init();

// Gumby is ready to go
Gumby.ready(function() {
	Gumby.log('Gumby is ready to go...', Gumby.dump());

	// placeholder polyfil
	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
		$('input, textarea').placeholder();

	}
	
	/* pretty photo
	========================= */
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
			theme: 'dark_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		});
	
	
	/* stat counter
	=========================*/
	if (matchMedia('only screen and (min-width: 769px)').matches) {
	$('.stat-counter').appear(function() {
			$('.stat-counter').each(function(){
				dataperc = $(this).attr('data-perc'),
				$(this).find('.count').delay(5000).countTo({
				from: 0,
				to: dataperc,
				speed: 2000,
				refreshInterval: 100
			});
		 });
		 });
	}	 	
	if (matchMedia('only screen and (max-width: 768px)').matches) {
	$('.stat-counter').each(function(){
				dataperc = $(this).attr('data-perc'),
				$(this).find('.count').delay(5000).countTo({
				from: 0,
				to: dataperc,
				speed: 2000,
				refreshInterval: 100
			});
	});
	}
	
	
	
	
	/* testimonial initialize
	=========================*/
	$('.testimonials').flexslider({
		animation: "slide",
		slideshow: false
	});


	
	/* twitter
	=========================*/
	$('.tweet').tweet({
		username: "envato",
		modpath: '/twitter/',
		count: 1,
		loading_text: 'loading twitter feed...'
	});

// Oldie document loaded
}).oldie(function() {
	Gumby.warn("This is an oldie browser...");

// Touch devices loaded
}).touch(function() {
	Gumby.log("This is a touch enabled device...");
	
});

// Document ready
$(function() {
	
	// skip link and toggle on one element
	// when the skip link completes, trigger the switch
	$('#skip-switch').on('gumby.onComplete', function() {
		$(this).trigger('gumby.trigger');
	});


/* Nav clicks
===================== */

$('.nav-button a').on(Gumby.click,function(){
  
  $('.nav-button').toggleClass('rotate');

  $('ul.navigation').toggleClass('active');

});

if (matchMedia('only screen and (max-width: 768px)').matches) {
$('.navigation li a').on(Gumby.click,function(){

  $('.nav-button').toggleClass('rotate');

  $('ul.navigation').toggleClass('active');

});

}

/* Modal clicks
===================== */

$('.modal-button a').on(Gumby.click, function() {

  $('body').addClass('overflow');

});

$('.modal .switch').on(Gumby.click, function() {

  $('body').removeClass('overflow');

});


});


/* Navigation
======================== */

$(window).load(function(){
// Cache selectors
var lastId,
    topMenu = $(".navigation"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=#"+id+"]").parent().addClass("active");
   }                   
});


/* portfolio filters
	=========================*/
	$(function() {
	 // cache container
	var $container = $('#projects.grid');


	// initialize isotope
	$container.isotope();
	$container.isotope('reLayout');
	// filter items when filter link is clicked
	$('#filters a').click(function(){
	  var selector = $(this).attr('data-filter');
	  $container.isotope({ filter: selector });
	  return false;
	});
	var $optionSets = $('#options .option-set'),
			  $optionLinks = $optionSets.find('a');
		  $optionLinks.click(function(){
			var $this = $(this);
			// don't proceed if already selected
			if ( $this.hasClass('selected') ) {
			  return false;
			}
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');
	 });
	});
});
});