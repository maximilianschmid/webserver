/**
 * Link-Target Page will scroll to stored position
 * e.g. for Gallerys or pagination navigations
 *
 * depends on
 * _baselib/jquery.js
 * _baselib/jquery.ba-bbq.js
 */

(function($) {
  $.fn.stickylink = function(options) {
    // build main options before element iteration
    var opts = $.extend({}, $.fn.stickylink.defaults, options);
    // iterate and reformat each matched element
    return this.each( function() {
      var $this = $(this);

      // build element specific options
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

      $this.addClass("stickylink");

      $this.click( function() {
        if ($.cookie('scrolltop') === null ){
          $.cookie('scrolltop', "0" , { path: '/', expires: 7 });
        }
        
        if (o.maxscroll) {
          if ($(window).scrollTop() > o.maxscroll) {
            position = o.maxscroll;
          } else {
            position = $(window).scrollTop();
          }
        } else {
          position = $(window).scrollTop();
        }
        
        //fix webkit zoom 1 px bug
        var difference =  Math.abs( $.cookie('scrolltop') - position );
        if ( difference < 3 ){
          position = $.cookie('scrolltop');
        }

        var url = $this.attr("href");
        var paramsStr = "scrolltop="+position;
        var newUrl = $.param.fragment( url, paramsStr );
        
        //fix webkit zoom 1 px bug
        $.cookie('scrolltop', position , { path: '/', expires: 7 });
        $this.attr("href", newUrl);

      });//click
   
     });//each()
  };
})(jQuery);




jQuery(document).ready(function(){
  //scroll to position defined in hash
  if (window.location.hash){
    // Deserialize current document fragment into an object.
    var myObj = $.deparam.fragment();
    jQuery(window).scrollTop(myObj.scrolltop);
  }
});