/**
 * anorak.hdswitch jQuery UI widget
 * 
 */

(function($) {
  $.widget("anorak.mobileheader", {
    options: {
      
    },
    
    _create: function() {
      var self = this; 
      var element = self.element;
      
      
      $(".mobileheader_togglebutton").click(function(){
        self.toggle();
      });
      
      element.find("a").click(function(){
        self.toggle();
      });
      
      
      
    },//_create()
    
    toggle: function(){
      var self = this; 
      var element = self.element;
      var mobileheader_content_wrap = element.find(".mobileheader_content_wrap");

      //uses CSS3 transitions for animation     
      if ( element.hasClass("mobileheader_open") ){
        element.removeClass("mobileheader_open");
        mobileheader_content_wrap.css("height", "0px" );
        //nav_main_ul_wrap.animate({height:0}, 500, "easeOutExpo");
        //scroll to navigation startpoint
        $("html, body").animate({scrollTop:0}, 500, "easeInOutExpo");
      }else{
        element.addClass("mobileheader_open");
        //nav_main_ul_wrap.animate({height: element.find("ul").height() }, 500, "easeOutExpo");
        mobileheader_content_wrap.css("height", element.find(".mobileheader_content").height()+"px" );
      }
    }
          
  });//$.widget
})(jQuery);