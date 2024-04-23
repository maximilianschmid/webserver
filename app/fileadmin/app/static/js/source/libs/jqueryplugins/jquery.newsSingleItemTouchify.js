/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 * requires:
 * jquery.swipe.js
 */

//
// create closure
//
(function($) {
  //
  // plugin definition
  //
  $.fn.newsSingleItemTouchify = function(options) {
  	// build main options before element iteration
  	var opts = $.extend({}, $.fn.newsSingleItemTouchify.defaults, options);
  	// iterate and reformat each matched element
  	return this.each(function() {
  		var $this = $(this);
  		
  		// build element specific options
  		var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
  		
  		// call our format function
  		//markup = $.fn.newsSingleItemTouchify.publicFunction();
  		
  		$this.find("a").click(function(e){
  			event.preventDefault();
  		});
  		
  		jQuery($this).swipe({
  			swipeLeft: function(event) { 
  
  			},
  			swipeRight: function(event) {
  
  			},
  			touchStart: function(event){ 
  
  			},
  			touchMove: function(event, changeX){ 
  				//changeX is the absolute value from beginning of touch
  				slider = $this;
  				console.log($this.attr("class"));
  				newMargin = 0 - changeX;
  				slider.css("padding-left", newMargin+"px");
  			},		
  			tap: function(event){ 
  
  			},
  			touchReset: function(event){ 
  	
  			}	
  				
  		});
  				
  	});//each
  };
  //
  // define and expose our format function
  //
  $.fn.newsSingleItemTouchify.publicFunction= function() {

	return html;
  };
  
  //
  // plugin defaults
  //
  $.fn.newsSingleItemTouchify.defaults = {
  	"examplevalue": "value1"
  };
//
// end of closure
//
})(jQuery);