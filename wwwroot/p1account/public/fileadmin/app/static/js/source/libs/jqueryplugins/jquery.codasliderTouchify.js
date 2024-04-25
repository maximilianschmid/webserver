/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 * requires:
 * jquery.swipe.js
 */

//
// create closure
//
 (function($){
    //
    // plugin definition
    //
    $.fn.codasliderTouchify = function(options){
        // build main options before element iteration
        var opts = $.extend({},
        $.fn.codasliderTouchify.defaults, options);
        // iterate and reformat each matched element
        return this.each(function(){
            $this = $(this);
            // build element specific options
            var o = $.meta ? $.extend({},
            opts, $this.data()) : opts;

            var slider = $this.parents(".coda-slider-wrapper");
            var movingPanel = slider.find(".panel-container");
            var startMargin;


            var defaults = {
              threshold: {
                x: 10,
                //swipe threshold in absolute pixels
                y: 3,
                // specifies proportion between movement in x/y direction
                tapX: 3,
                //tap threshold in pixels
                tapY: 3
                //tap threshold in pixels      
              }
            };
            
            // Private variables for each element
            var originalCoord = {
                x: 0,
                y: 0
            };
            var finalCoord = {
                x: 0,
                y: 0
            };
            
            // to make the whole area clickable is bad for
            // - pinching
            // - triggers unwanted clicks
            // - degrades performance
            // - user does not know what happened when click is triggered
            /*movingPanel.tap(function(){
              if (movingPanel.find(".panel a").size() > 0){
                window.location.href = "/" + slider.find(".panel a.morelink").eq(getCurrentActivePanelIndex(slider)).attr("href");
              }
            });*/
            
            movingPanel.touchstart(function(){
              slider.addClass("stopautoslide");
            });

            if (o.transition === "fade"){
              movingPanel.swipeleft(function(){
                slider.find(".coda-nav-right a").trigger("click");
              });
              
              movingPanel.swiperight(function(){
                slider.find(".coda-nav-left a").trigger("click");
              });
            }else{               
              movingPanel.swipeleft(function(){
                slider.find(".coda-nav-right a").trigger("click");
              });
              
              movingPanel.swiperight(function(){
                slider.find(".coda-nav-left a").trigger("click");
              });
  
              function touchStart(event){
                firstFinger = event.targetTouches[0];
  
                originalCoord.x = firstFinger.pageX;
                originalCoord.y = firstFinger.pageY;
  
                //initialize finalCoord on touchStart with appropriate coords
                finalCoord.x = firstFinger.pageX;
                finalCoord.y = firstFinger.pageY;
  
                //changeX is the absolute value from beginning of touch
                startMargin = parseInt(movingPanel.css("margin-left"));
              }
              
              function touchMove(event){
                // event.preventDefault();  // prevents page scrolling
                finalCoord.x = firstFinger.pageX;
                finalCoord.y = firstFinger.pageY;
  
                var changeX = originalCoord.x - finalCoord.x;
                var changeY = originalCoord.y - finalCoord.y;
  
                newMargin = startMargin - changeX;
                movingPanel.stop();
                movingPanel.css("margin-left", newMargin + "px");
              }
                  
              
              function touchEnd(event){
                debug("touchEnd");
                touchReset(event);
              }  
  
              function touchCancel(event){
                debug("touchCance");
              }
                                
              function gestureStart(event){
                debug("gestureStart");
              } 
              
              function gestureEnd(event){
                debug("gestureEnd");
              } 
  
  
              function touchReset(event){
                //only reset margin-left
                marginLeft = parseInt($(event.target).parents(".coda-slider-wrapper .panel-container .panel:first").width()) * parseInt(getCurrentActivePanelIndex($(event.target).parents(".coda-slider-wrapper")) * -1);
                movingPanel.stop().animate({
                    marginLeft: marginLeft
                  },
                  500,
                  "easeOutExpo"
                );
              }
                          
              function getCurrentActivePanelIndex(element){
                  var listItem = jQuery(element).find(".coda-nav a.current");
                  return jQuery(element).find(".coda-nav a").index(listItem);
              }
              
              
              //check for touch support - IE doesn't throws error on touch events
              if (Modernizr.touch){
                // Add gestures to all swipable areas
                this.addEventListener("touchstart", touchStart, false);
                this.addEventListener("touchmove", touchMove, false);
                this.addEventListener("touchend", touchEnd, false);
                this.addEventListener("touchcancel", touchCancel, false);
                this.addEventListener("gesturestart", gestureStart, false);
                this.addEventListener("gestureend", gestureEnd, false);
              }
              
           }//if transition is slide            
            

        });
    };
})(jQuery);