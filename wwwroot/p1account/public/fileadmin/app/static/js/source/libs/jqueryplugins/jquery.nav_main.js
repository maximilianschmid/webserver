/**
 * anorak.hdswitch jQuery UI widget
 * 
 */

(function($) {
  $.widget("anorak.nav_main", {
    options: {
      
    },
    
    _create: function() {
      var self = this; 
      var element = self.element;
      
      $(".nav_main_togglebutton").click(function(){
        self.toggle();
      });
      
      element.find("a").click(function(){
        self.toggle();
      });
      
    },//_create()
    
    toggle: function(){
      var self = this; 
      var element = self.element;
      var nav_main_ul_wrap = element.find(".nav_main_ul_wrap");

      //uses CSS3 transitions for animation     
      if ( element.hasClass("nav_main_open") ){
        element.removeClass("nav_main_open");
        nav_main_ul_wrap.css("height", "0px" );
        //nav_main_ul_wrap.animate({height:0}, 500, "easeOutExpo");
        //scroll to navigation startpoint
        $("html, body").animate({scrollTop:0}, 500, "easeInOutExpo");
      }else{
        element.addClass("nav_main_open");
        //nav_main_ul_wrap.animate({height: element.find("ul").height() }, 500, "easeOutExpo");
        nav_main_ul_wrap.css("height", element.find("ul").height()+"px" );
      }
    }
          
  });//$.widget
})(jQuery);