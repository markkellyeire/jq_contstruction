// Triggered when the DOM is ready.
$(function() {
	
	// Load the helpers.
	var helpers = new Helpers();
	
	// DOM is ready... do yer thang!
	
});
/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0.3
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
          cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = cssStyles;

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

/*
 * jQuery Tiny Pub/Sub
 * https://github.com/cowboy/jquery-tiny-pubsub
 *
 * Copyright (c) 2013 "Cowboy" Ben Alman
 * Licensed under the MIT license.
 */

(function($) {

  var o = $({});

  $.subscribe = function() {
    o.on.apply(o, arguments);
  };

  $.unsubscribe = function() {
    o.off.apply(o, arguments);
  };

  $.publish = function() {
    o.trigger.apply(o, arguments);
  };

}(jQuery));
var Helpers = (function( $ ) {
	'use strict';
	
	/**
	 * Enables a few helpers that are used throughout the site.
	 *
	 * @return {void}
	 */
	var helpers = function() {
		enableJQueryExists();
		enableEqualiseHeights();
		enableThrottledResize();
		enableFitVids();
	};
	
	
	/**
	 * Defines a jQuery function that allows us to check if an element exists
	 * and run a callback function if it exists.
	 * 
	 * @example
	 * $( '#my-element' ).exists(function() {
	 *     // Element exists, run my code.
	 * });
	 *
	 * @return {void}
	 */
	var enableJQueryExists = function() {
		$.fn.exists = function( callback ) {
			var args = [].slice.call( arguments , 1 );
			
			if ( this.length ) callback.call( this , args );
			
			return this;
		};
	};
	
	/**
	 * Defines a method to allow a parent element equalise the heights of
	 * its child elements.
	 * 
	 * @example
	 * <div data-equalise=".column">
	 *     <div class=".column">...</div>
	 *     <div class=".column">...</div>
	 *     <div class=".column">...</div>
	 * </div>
	 *
	 * @return {void}
	 */
	var enableEqualiseHeights = function() {
		var run = function() {
			$('[data-equalise]').each(function( i , e ) {
				var $parent   = $(e),
					$children = $parent.find( $parent.data('equalise') ),
					highest   = 0;
				
				// Reset the heights so we can re-calculate the highest item.
				$children.height( 'auto' );
				
				// Get the highest element.
				$children.each(function( i , e ) {
					var height = $(e).height();
					
					if ( height > highest ) highest = height;
				});
				
				$children.height( highest );
			});
		};
		
		// Make this responsive and auto-adjust when the browser is resized.
		$.subscribe( 'throttled-resize' , run );
		
		run();
	};
	
	/**
	 * Since the resize event on the Window object throws too many events,
	 * it could lead to browser lag. What we'll do is set up a custom event
	 * that is called a few milliseconds after the user stops resizing the
	 * window. This helps throttle the resize event and reduce lag.
	 * 
	 * @requires tiny.pubsub.min.js
	 * @event throttled-resize
	 * 
	 * @return {void}
	 */
	var enableThrottledResize = function() {
		var timeout;
		
		$( window ).on( 'resize' , function( event ) {
			clearTimeout( timeout );
			
			timeout = setTimeout(function() {
				$.publish( 'throttled-resize' );
			}, 50);
		});
	};
	
	/**
	 * Enables the fitVids plugin that makes iframes responsive.
	 *
	 * @return {void}
	 */
	var enableFitVids = function() {
		$( 'iframe' ).parent().fitVids();
	};
	
	return helpers;
})( jQuery );