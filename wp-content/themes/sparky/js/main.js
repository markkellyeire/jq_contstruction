$(function(){new Helpers;$("[data-bg]").each(function(a,t){var c=$(t),e=c.data("bg");c.backstretch(e)})});
!function(t){"use strict";t.fn.fitVids=function(e){var i={customSelector:null};if(!document.getElementById("fit-vids-style")){var r=document.createElement("div"),a=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0],o="&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";r.className="fit-vids-style",r.id="fit-vids-style",r.style.display="none",r.innerHTML=o,a.parentNode.insertBefore(r,a)}return e&&t.extend(i,e),this.each(function(){var e=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];i.customSelector&&e.push(i.customSelector);var r=t(this).find(e.join(","));r=r.not("object object"),r.each(function(){var e=t(this);if(!("embed"===this.tagName.toLowerCase()&&e.parent("object").length||e.parent(".fluid-width-video-wrapper").length)){var i="object"===this.tagName.toLowerCase()||e.attr("height")&&!isNaN(parseInt(e.attr("height"),10))?parseInt(e.attr("height"),10):e.height(),r=isNaN(parseInt(e.attr("width"),10))?e.width():parseInt(e.attr("width"),10),a=i/r;if(!e.attr("id")){var o="fitvid"+Math.floor(999999*Math.random());e.attr("id",o)}e.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*a+"%"),e.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto);
!function(n){var u=n({});n.subscribe=function(){u.on.apply(u,arguments)},n.unsubscribe=function(){u.off.apply(u,arguments)},n.publish=function(){u.trigger.apply(u,arguments)}}(jQuery);
var Helpers=function(t){"use strict";var i=function(){e(),n(),r(),u()},e=function(){t.fn.exists=function(t){var i=[].slice.call(arguments,1);return this.length&&t.call(this,i),this}},n=function(){var i=function(){t("[data-equalise]").each(function(i,e){var n=t(e),r=n.find(n.data("equalise")),u=0;r.height("auto"),r.each(function(i,e){var n=t(e).height();n>u&&(u=n)}),r.height(u)})};t.subscribe("throttled-resize",i),i()},r=function(){var i;t(window).on("resize",function(){clearTimeout(i),i=setTimeout(function(){t.publish("throttled-resize")},50)})},u=function(){t("iframe").parent().fitVids()};return i}(jQuery);