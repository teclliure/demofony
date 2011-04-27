	
	(function($) {
	
		var methods = {
			init: function(options){
			
				return this.bind("click", function(){
					
					var settings = {
				    	width: 200,
				    	height: 200,
				    	load: null,
				    	html: null,
				    	finish: null
				    };
			
					if ( options ) { 
						$.extend( settings, options );
					}
					
					$("div.modal_alpha,div.modal_div").remove();
					
					var alpha = $("<div class='modal_alpha'>").appendTo("body").fadeIn();
					var div = $("<div class='modal_div'>").appendTo("body");
					
					if(settings.html){
						settings.html(div).modal("reposition").fadeIn();
					}
					
					if(settings.load){
						div.load(settings.load, function(){
							if(settings.finish)
								settings.finish($(this));
							$(this).modal("reposition").fadeIn();
						});
					}
					
					return false;
					
				});
			},
	    	reposition: function(){
				return this.each(function(){
					$(this).css({marginLeft: - ($(this).width() / 2), marginTop: - ($(this).height() / 2)});
				});
			},
			destroy : function( ) {
				return this.each(function(){
					//$(window).unbind('.modal');
				});
			}
	    };
	
		$.fn.modal = function(options_or_method) {
		     		    
			if ( methods[options_or_method] ) {
				return methods[options_or_method].apply( this, Array.prototype.slice.call( arguments, 1 ));
			} else if ( typeof options_or_method === 'object' || ! options_or_method ) {
				return methods.init.apply( this, arguments );
			} else {
				//$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
			}  
	
		}
		
		
	})(jQuery);