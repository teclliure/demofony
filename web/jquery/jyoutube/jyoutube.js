/*
 * jYoutube 1.0 - YouTube video image getter plugin for jQuery
 *
 * Copyright (c) 2009 jQuery Howto
 *
 * Licensed under the GPL license:
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Plugin home & Author URL:
 *   http://jquery-howto.blogspot.com
 *
 */
(function($){
	$.extend({
		jYoutube: function( url, size ){
			if(url === null){ return ""; }

			size = (size === null) ? "big" : size;
			var vid;
			var results;

			results = url.match("[\\?&]v=([^&#]*)");

			vid = ( results === null ) ? url : results[1];

			if(size == "small"){
				return "http://img.youtube.com/vi/"+vid+"/2.jpg";
			}else {
				return "http://img.youtube.com/vi/"+vid+"/0.jpg";
			}
		}
	})
})(jQuery);