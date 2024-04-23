/**
 * 960 gridder
 * http://gridder.andreehansson.se/
 */
var gOverride = {
    urlBase: "http://" + window.location.host + "/fileadmin/app/static/js/libs/jquery/",
    gColor: '#fff',
    gColumns: 12,
    gOpacity: 0.05,
    gWidth: 10,
    pColor: '#fff',
    pHeight: 16,
    pOffset: 0,
    pOpacity: 0.2,
    center: true,
    gEnabled: true,
    pEnabled: true,
    setupEnabled: true,
    fixFlash: true,
    size: 960,
    invert: true
};

/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */

jQuery(document).ready(function(){
	jQuery("body").gridder();
});

//
// create closure
//
(function($) {
  //
  // plugin definition
  //
  $.fn.gridder = function(options) {
	// build main options before element iteration
	var opts = $.extend({}, $.fn.gridder.defaults, options);
	// iterate and reformat each matched element
	return this.each(function() {
		$this = $(this);
		
		// build element specific options
		var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

		/*
		 * improve FE-Edit
		 * cookie tutorial
		 * http://www.electrictoolbox.com/jquery-cookies/
		 */
		
		hostname_array = location.hostname.split(".")
		hostname_array.reverse();
		if (hostname_array[0] === "local"){
			cookieDomain = hostname_array[2]+"."+hostname_array[1]+"."+hostname_array[0];
		}else{
			cookieDomain = hostname_array[1]+"."+hostname_array[0];
		}
	
		var editOnText = "Gridder ein";
		var editOffText = "Gridder aus";

		//check for cookie
		if ( jQuery.cookie("gridder-enabled") == "false" || jQuery.cookie("gridder-enabled") === null){
			disableEdit();
		}else{
			enableEdit();
		}
		
		jQuery(".onoff").click(function(e){
			e.preventDefault();
			if (jQuery("body").hasClass("gridder-enabled")){
				disableEdit();
			}else{
				enableEdit();
			}
		});

		function enableEdit(){
			jQuery("#g-grid").show();
			jQuery("body").addClass("gridder-enabled");
			jQuery.cookie("gridder-enabled", "true", { path: '/', domain: cookieDomain });
		}
	
		function disableEdit(){
			jQuery("#g-grid").hide();
			jQuery("body").removeClass("gridder-enabled");
			jQuery.cookie("gridder-enabled", "false", { path: '/', domain: cookieDomain });
		}	

	});
};

})(jQuery);