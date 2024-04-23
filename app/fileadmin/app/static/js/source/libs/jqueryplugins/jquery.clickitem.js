/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */
(function($) {
  $.fn.clickitem = function(options) {
    // build main options before element iteration
    var opts = $.extend({}, $.fn.clickitem.defaults, options);
    // iterate and reformat each matched element
    return this.each( function() {
      $this = $(this);

      // build element specific options
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

      var currentElement = $this;

      // check for existing a-tag - only then add click handler
      // ignore those a-tags inside the feedit-forms
      // ignore tel: protocol hrefs
      var target_url = currentElement.find("a")
      .filter( function (index) {
        //check for tel: protocol in href
        //debug( jQuery(this).attr("href") );
        if (jQuery(this).attr("href").substring(0,4) == "tel:") {
          keepitem = false;
        } else {
          keepitem = true;
        }
        //debug(removeitem);
        return keepitem;
      })
      .not( currentElement.find(".feedit-form a") )
      .not( currentElement.find(".frontEndEditIconLinks") )
      .last()
      .attr("href");

      currentElement.click( function(e) {
        if (e.target.href && e.target.href.substring(0,4) == "tel:"){
          // don't follow url
        }else{
          window.location.href = target_url; 
        }
      });
      
    });
  };
})(jQuery);
/**
 * all clicks with mouseover pointer
 */
/*
 * pointer-cursor for all JavaScript click-event-elements
 * http://davidwalsh.name/add-events-jquery
 */
jQuery.event.special.click = {
  setup: function() {
    jQuery(this).css('cursor', 'pointer');
    return false;
  },
  teardown: function() {
    jQuery(this).css('cursor', '');
    return false;
  }
};