/*
 * test for mobile version
 */
Modernizr.addTest('mobile',function(){
  return jQuery("body").hasClass("mobile");
});

/*
 * check for ie7 ( IE Version smaller than 7 )
 */
Modernizr.addTest('ie6',function(){
    if ( jQuery.browser.msie && parseInt(jQuery.browser.version.substr(0, 1), 10) < 7 ){
      return true;
    }else{
      return false;
    }
});

/*
 * check for ie7 ( IE Version smaller than 8 )
 */
Modernizr.addTest('ie7',function(){
    if ( jQuery.browser.msie && parseInt(jQuery.browser.version.substr(0, 1), 10) < 8 ){
      return true;
    }else{
      return false;
    }
});

/*
 * check for ie8 ( IE Version smaller than 9 )
 */
Modernizr.addTest('ie8',function(){
    if ( jQuery.browser.msie && parseInt(jQuery.browser.version.substr(0, 1), 10) < 9 ){
      return true;
    }else{
      return false;
    }
});

/*
 * check for production server
 */
Modernizr.addTest('production',function(){
    if ( window.location.host.split(".").reverse()[0] === "local" ){
      return false;
    }else{
      return true;
    }
});