/**
 * anorak.hdswitch jQuery UI widget
 * 
 */

(function($) {
  $.widget("anorak.versionswitcher", {
    options: {
      
    },
    
    _create: function() {
      var self = this; 
      var $element = self.element;
      
      var domain = window.location.host;
      var cookiedomain = "";
      var dot = ".";

      //strip www., mobile. and pc. away from the domain
      var domainparts = domain.split(".");
      if (domainparts[0] === "www" || domainparts[0] === "mobile" || domainparts[0] === "pc"){
        domainparts_stripped = domainparts.splice(1, 100);
        for (var i = 0; i < domainparts_stripped.length; i++) {
          if ( i === domainparts_stripped.length-1){
            dot = "";
          }
          cookiedomain += domainparts_stripped[i]+dot;
        }      
      }else{
        cookiedomain = domain;
      }

      $element.click(function(){
        // check for .mobile Class in body Tag
        // .mobile Class respects aio_detectmobilebrowser logic !!
        if ( $("body").hasClass("mobile") ){
          $.cookie('aio_version', 'pc', { expires: 365, path: '/', domain: cookiedomain});  
        }else{
          $.cookie('aio_version', 'mobile', { expires: 365, path: '/', domain: cookiedomain});
        }
        
        //if subdomain is mobile or pc, reset to www cause JavaScript is turned on again
        if (domainparts[0] === "mobile" || domainparts[0] === "pc"){
          var url = "http://www."+cookiedomain + window.location.pathname + window.location.search + window.location.hash;
          window.location = url;          
        }else{
          window.location.reload();
        }  
        
        return false;
      });

      
    },//_create()
          
  });//$.widget
})(jQuery);