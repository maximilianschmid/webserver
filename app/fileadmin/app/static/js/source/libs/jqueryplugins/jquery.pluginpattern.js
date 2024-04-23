/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */
(function($) {
  $.fn.feedit = function(options) {
  	// build main options before element iteration
  	var opts = $.extend({}, $.fn.feedit.defaults, options);
  	// iterate and reformat each matched element
  	return this.each(function() {
  		var $this = $(this);
  		
  		// build element specific options
  		var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
  		
  		// call our format function
  		//markup = $.fn.feedit.publicFunction();
  	});//.each
  };

  $.fn.feedit.publicFunction= function() {
  	return html;
  };

  $.fn.feedit.defaults = {
  	"examplevalue": "value1"
  };

})(jQuery);