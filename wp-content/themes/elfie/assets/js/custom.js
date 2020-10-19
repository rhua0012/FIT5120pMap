//Slick slider
(function($) {

	//Args set from HTML data attribute
	$( document ).ready(function() {
		$( '.slider-inner' ).slick();
	});
})( jQuery );

//Mobile menu
(function($) {

	var	menuType = 'desktop';

	$(window).on('load resize', function() {
		var currMenuType = 'desktop';

		if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches ) {
			currMenuType = 'mobile';
			var headerHeight = $( '#masthead' ).outerHeight();
		}

		if ( currMenuType !== menuType ) {
			menuType = currMenuType;

			if ( currMenuType === 'mobile' ) {
				var $mobileMenu = $('#site-navigation').attr('id', 'mobile-navigation');
				var hasChildMenu = $('#mobile-navigation').find('li:has(ul)');

				hasChildMenu.addClass( 'has-submenu' );

				hasChildMenu.children('a').after('<span class="submenu-toggle"><a href="#">+</a></span>');
				$('.menu-toggle').removeClass('active');
				$( '#mobile-navigation > div > ul' ).css( 'top', headerHeight - 20 );

				//Trap focus inside mobile menu modal
				//Based on https://codepen.io/eskjondal/pen/zKZyyg
				var modal 			= $( '.primary-menu' );
				var menuClose 		= $( '.menu-close-button' );
				var tabbable 		= modal.find( 'li' );
				var firstTabbable 	= tabbable.first();
				var lastTabbable 	= tabbable.last();
			
				lastTabbable.on('keydown', function (e) {
					if (e.which === 9 && !e.shiftKey) {
						e.preventDefault();
						menuClose.focus();
					}
				});
	
				firstTabbable.on('keydown', function (e) {
					if (e.which === 9 && e.shiftKey) {
						e.preventDefault();
						menuClose.focus();
					}
				});
	
				menuClose.on('keydown', function (e) {
					if (e.which === 9 && e.shiftKey) {
						e.preventDefault();
						lastTabbable.find( 'a' ).focus();
					}
				});


			} else {
				var $desktopMenu = $('#mobile-navigation').attr('id', 'site-navigation').removeAttr('style');
				$desktopMenu.find( '> div > ul' ).removeAttr( 'style' );
				$desktopMenu.find('.submenu').removeAttr('style');
				$('.submenu-toggle').remove();
			}
		}
	});

	$('.menu-toggle').on('click', function() {
		$( this ).toggleClass( 'active' );
		$( '#mobile-navigation' ).toggleClass('active');
	});
	
	$('.menu-close-button').on('click', function() {
		$( '#mobile-navigation' ).removeClass('active');
	});		

	$(document).on('click', '#mobile-navigation li .submenu-toggle', function(e) {
		e.preventDefault();

		$(this).text( ($(this).text() == '+') ? '-' : '+' );
		
		$(this).toggleClass('active').next('ul').slideToggle();
		e.stopImmediatePropagation()
	});


})( jQuery );

//Adds focus class for menu items with children. From TwentyTwenty
(function($) {

	var elfiefocusmenu = elfiefocusmenu || {};
	elfiefocusmenu.primaryMenu = {

		init: function() {
			this.focusMenuWithChildren();
		},

		focusMenuWithChildren: function() {
			// Get all the link elements within the primary menu.
			var links, i, len,
				menu = document.querySelector( '#site-navigation' );

			if ( ! menu ) {
				return false;
			}

			links = menu.getElementsByTagName( 'a' );

			// Each time a menu link is focused or blurred, toggle focus.
			for ( i = 0, len = links.length; i < len; i++ ) {
				links[i].addEventListener( 'focus', toggleFocus, true );
				links[i].addEventListener( 'blur', toggleFocus, true );
			}

			//Sets or removes the .focus class on an element.
			function toggleFocus() {
				var self = this;

				// Move up through the ancestors of the current link until we hit .primary-menu.
				while ( -1 === self.className.indexOf( 'primary-menu' ) ) {
					// On li elements toggle the class .focus.
					if ( 'li' === self.tagName.toLowerCase() ) {
						if ( -1 !== self.className.indexOf( 'focus' ) ) {
							self.className = self.className.replace( ' focus', '' );
						} else {
							self.className += ' focus';
						}
					}
					self = self.parentElement;
				}
			}
		}
	};

	elfiefocusmenu.primaryMenu.init();

})( jQuery );

//Back to top button
(function($) {
	var backToTop = function() {

		var toTopBtn = $( '.back-to-top' );

		$(window).scroll(function() {
			if ( $(this).scrollTop() > 800 ) {
				toTopBtn.addClass('show');
			} else {
				toTopBtn.removeClass('show');
			}
		});

		toTopBtn.on('click', function() {
			$( 'html, body' ).animate({ scrollTop: 0 }, 1000);
			return false;
		});
	};

	backToTop();

})( jQuery );