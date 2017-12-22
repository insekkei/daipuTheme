/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	//设置背景图为随机
    var random_bg=Math.floor(Math.random()*5+1);
    var bg='url(/wp-content/themes/daipu/images/background/bg_'+random_bg+'.jpg)';
    $('.site-main.index').css("background-image",bg);
    $('.home #widget-area .cat-post-widget').css('background-image', bg);

    $('.cat-post-widget').prepend('<span class="cat-post-widget-close">&times;</span>');

    // var closePostLink = localStorage.getItem('closePostLink');
    // var catPostLink = $('.cat-post-everything-is-link').attr('href');

    // if (closePostLink === catPostLink) {
    //   $('.cat-post-widget').addClass('hide');
    // }
    $(document).on('click', '.cat-post-widget', function(e) {
      // localStorage.setItem('closePostLink', catPostLink);
      $('.cat-post-widget').addClass('hide');
    })

    $(document).on('click', '.press article a', function(e) {
      e.preventDefault()
      $(this).parents('article').find('.modal').addClass('show');
    })
    $(document).on('click', '.modal.show', function(e) {
      $('.modal').removeClass('show');
    })

    $(document).on('click', '.entry-content p img:not(.attachment-post-thumbnail)', function(e) {
      e.preventDefault()
      var imgSrc = $(this).attr('src');
      $('#main').append('<div class="globalFullScreenModal"><img src=' + imgSrc + ' /></div>');
      $(document).on('click', '.globalFullScreenModal', function(e) {
        $(this).hide()
      })
    })

	var stopBubble = function (e) {
		//如果提供了事件对象，则这是一个非IE浏览器
		if(e && e.stopPropagation) {
			//因此它支持W3C的stopPropagation()方法
			e.stopPropagation();
		} else {
			//否则，我们需要使用IE的方式来取消事件冒泡
			window.event.cancelBubble = true;
		}
		return false;
	};

	var winHeight = $(window).height();
	$('.overlay').css('height',winHeight-118);

	$(document).on('click','#menu-nav .menu-item-has-children>a, #menu-nav-chinese .menu-item-has-children>a',function(e){
		$(this).parent('li').children('.sub-menu').toggle(0);
		$(this).parent('li').siblings('.menu-item-has-children').children('ul').fadeOut(0);
		stopBubble(e);
		e.preventDefault();
	});

	$(document).click(function(e){
			$('.menu-item-has-children').children('ul').fadeOut(0);
	});
	var $body, $window, $sidebar, adminbarOffset, top = false,
	    bottom = false, windowWidth, windowHeight, lastWindowPos = 0,
	    topOffset = 0, bodyHeight, sidebarHeight, resizeTimer,
		secondary, button;

	// Add dropdown toggle that display child menu items.
	$( '.main-navigation .menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

	// Toggle buttons and submenu items with active children menu items.
	$( '.main-navigation .current-menu-ancestor > button' ).addClass( 'toggle-on' );
	$( '.main-navigation .current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

	$( '.dropdown-toggle' ).click( function( e ) {
		var _this = $( this );
		e.preventDefault();
		_this.toggleClass( 'toggle-on' );
		_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
	} );

	secondary = $( '#secondary' );
	button = $( '.site-branding' ).find( '.secondary-toggle' );

	// Enable menu toggle for small screens.
	( function() {
		var menu, widgets, social;
		if ( ! secondary || ! button ) {
			return;
		}

		// Hide button if there are no widgets and the menus are missing or empty.
		menu    = secondary.find( '.nav-menu' );
		widgets = secondary.find( '#widget-area' );
		social  = secondary.find( '#social-navigation' );
		if ( ! widgets.length && ! social.length && ( ! menu || ! menu.children().length ) ) {
			button.hide();
			return;
		}

		button.on( 'click.twentyfifteen', function() {
			secondary.toggleClass( 'toggled-on' );
			secondary.trigger( 'resize' );
			$( this ).toggleClass( 'toggled-on' );
			if ( $( this, secondary ).hasClass( 'toggled-on' ) ) {
				$( this ).attr( 'aria-expanded', 'true' );
				secondary.attr( 'aria-expanded', 'true' );
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
				secondary.attr( 'aria-expanded', 'false' );
			}
		} );
	} )();

	/**
	 * @summary Add or remove ARIA attributes.
	 * Uses jQuery's width() function to determine the size of the window and add
	 * the default ARIA attributes for the menu toggle if it's visible.
	 * @since Twenty Fifteen 1.1
	 */
	function onResizeARIA() {
		if ( 955 > $window.width() ) {
			button.attr( 'aria-expanded', 'false' );
			secondary.attr( 'aria-expanded', 'false' );
			button.attr( 'aria-controls', 'secondary' );
		} else {
			button.removeAttr( 'aria-expanded' );
			secondary.removeAttr( 'aria-expanded' );
			button.removeAttr( 'aria-controls' );
		}
	}

	// Sidebar scrolling.
	function resize() {
		windowWidth = $window.width();

		if ( 955 > windowWidth ) {
			top = bottom = false;
			$sidebar.removeAttr( 'style' );
		}

		winHeight = $(window).height();
		$('.overlay').css('height',winHeight-112);
	}

	function scroll() {
		var windowPos = $window.scrollTop();

		if ( 955 > windowWidth ) {
			return;
		}

		sidebarHeight = $sidebar.height();
		windowHeight  = $window.height();
		bodyHeight    = $body.height();

		if ( sidebarHeight + adminbarOffset > windowHeight ) {
			if ( windowPos > lastWindowPos ) {
				if ( top ) {
					top = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! bottom && windowPos + windowHeight > sidebarHeight + $sidebar.offset().top && sidebarHeight + adminbarOffset < bodyHeight ) {
					bottom = true;
					$sidebar.attr( 'style', 'position: fixed; bottom: 0;' );
				}
			} else if ( windowPos < lastWindowPos ) {
				if ( bottom ) {
					bottom = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! top && windowPos + adminbarOffset < $sidebar.offset().top ) {
					top = true;
					$sidebar.attr( 'style', 'position: fixed;' );
				}
			} else {
				top = bottom = false;
				topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
				$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
			}
		} else if ( ! top ) {
			top = true;
			$sidebar.attr( 'style', 'position: fixed;' );
		}

		lastWindowPos = windowPos;
	}

	function resizeAndScroll() {
		resize();
		scroll();
	}

	$( document ).ready( function() {
		$body          = $( document.body );
		$window        = $( window );
		$sidebar       = $( '#sidebar' ).first();
		adminbarOffset = $body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

		$window
			.on( 'scroll.twentyfifteen', scroll )
			.on( 'load.twentyfifteen', onResizeARIA )
			.on( 'resize.twentyfifteen', function() {
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( resizeAndScroll, 500 );
				onResizeARIA();
			} );
		$sidebar.on( 'click.twentyfifteen keydown.twentyfifteen', 'button', resizeAndScroll );

		resizeAndScroll();

		for ( var i = 1; i < 6; i++ ) {
			setTimeout( resizeAndScroll, 100 * i );
		}
	} );

} )( jQuery );
