/**
 * anorak.hdswitch jQuery UI widget
 * 
 */

(function($) {
  $.widget("anorak.hdswitch", {
    options: {
      
    },
    
    _create: function() {
      var self = this; 
      var $hdswitch = self.element;
      
      var domain = window.location.host;
      var cookiedomain = "";
      var dot = ".";

      //strip www., mobile. and pc. away from the domain
      var domainparts = domain.split(".");
      if (domainparts[0] === "www" || domainparts[0] === "mobile" || domainparts[0] === "pc"){
        domainparts = domainparts.splice(1, 100);
        for (var i = 0; i < domainparts.length; i++) {
          if ( i === domainparts.length-1){
            dot = " ";
          }
          cookiedomain += domainparts[i]+dot;
        }      
      }else{
        cookiedomain = domain;
      }

      $hdswitch.click(function(){
        if ( $.cookie('hdswitch') === "on"){
          $.cookie('hdswitch', 'off', { expires: 365, path: '/', domain: cookiedomain});  
        }else{
          $.cookie('hdswitch', 'on', { expires: 365, path: '/', domain: cookiedomain});
        }
        window.location.reload();
        return false;
      });
      
    },//_create()
          
  });//$.widget
})(jQuery);