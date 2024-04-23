/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */
(function($) {
  $(document).ready(function($){
      // check if feedit is embedded into TYPO3 Backend
      if (top.location !== location){
          //in backend
          backend = true;
      } else {
          //not in backend
          backend = false;
      }
  
      var returnUrl = $.cookie("aio_feedit_returnurl");
      var closebutton = "<a href='" + returnUrl + "' class='aiofeedit_button aiofeedit_saveandclose'><span>close</span></a>";
  
     templavoila_feedit_modus = $.cookie("templavoila-feedit-modus");       
              
      // only execute if the mod1 was called by the feedit - passed by the feedit url var
     if (templavoila_feedit_modus == "true"){
          //not in backend
          
          if (!backend){
              $(".buttonsleft .buttongroup a").remove();
              $(".buttonsright .buttongroup a").remove();
              
              closebutton += "<a href='" + returnUrl + "' class='backtowebsite'>zurück zur Webseite</a>";
              $(".buttonsleft .buttongroup:first").html(closebutton);
          }else{
              //$(".buttonsleft .buttongroup .t3-icon-document-save-view").remove();
              $(".buttonsleft .buttongroup:first").html(closebutton);
          }
     }

     
  });
})(jQuery_aio_feedit);

// Code that uses other library's $ can follow here.
//get url parameter
function gup(name){
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null){
        return "";
    } else{
        return results[1];
    }
}