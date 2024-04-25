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
  $.fn.fancyboxTouchify = function(options) {
	// build main options before element iteration
	var opts = $.extend({}, $.fn.fancyboxTouchify.defaults, options);
	// iterate and reformat each matched element
	return this.each(function() {
		$this = $(this);
		
		// build element specific options
		var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
		
		// call our format function
		//markup = $.fn.fancyboxTouchify.publicFunction();


	});
  };
  //
  // define and expose our format function
  //
  $.fn.fancyboxTouchify.start = function() {
  	if (Modernizr.touch){
  		var fancybox = $(".fancybox-wrap");
      fancybox.swipeleft(function(){
        $(".fancybox-next").trigger("click");
      });
      
      fancybox.swiperight(function(){
        $(".fancybox-prev").trigger("click");
      });
    }
  };
  
  //
  // plugin defaults
  //
  $.fn.fancyboxTouchify.defaults = {
  	"examplevalue": "value1"
  };
//
// end of closure
//
})(jQuery);