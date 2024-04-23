/**
 * @author milian
 */

jQuery(document).ready(function(){

    /**
     * check out masonry for sitemap
     * http://desandro.com/resources/jquery-masonry
     */
    /*$('.csc-sitemap').masonry({
     singleMode: true,
     columnWidth: 100,
     itemSelector: '.box'
     });
     */
    debug("JavaScript executed.");

    /**
     * this additional CSS-Class allows to define CSS Styles which are only applied if JS is turned on
     */
    jQuery("body").addClass("js");
    
    /**
     * make items clickable
     */
    jQuery(".news-latest-item").clickitem();
    jQuery(".news-list-item").clickitem();
	  jQuery(".tx-indexedsearch-res .res").clickitem();


    /**
     * contentslider
     */ 

    if (Modernizr.touch){
      var sliderEasing = "easeOutExpo";
    }else{
      var sliderEasing = "easeInOutExpo";
    }
    
    $(".sliderelement_slidetransition").each(function(){
      var slider = $(this).find(".coda-slider");
      slider.codaSlider({
        dynamicTabs: true,
        dynamicTabsPosition: "bottom",
        autoHeight: false,
        autoSlide: true,
        autoSlideInterval: 3000,
        autoSlideStopWhenClicked: true,
        dynamicArrowLeftText: "<<",
        dynamicArrowRightText: ">>",
        panelTitleSelector: "div.tab-nav-texte",
        crossLinking: true,
        slideEaseDuration: 500,
        slideEaseFunction: sliderEasing,
        transition: "slide",
        hashURL: false
      });
    });

    /**
     * contentfader
     */ 
    $(".sliderelement_fadetransition").each(function(){
      var slider = $(this).find(".coda-slider");
      slider.codaSlider({
        dynamicTabs: true,
        dynamicTabsPosition: "bottom",
        autoSlide: true,
        autoSlideInterval: 3000,
        autoSlideStopWhenClicked: true,
        dynamicArrowLeftText: "<<",
        dynamicArrowRightText: ">>",
        panelTitleSelector: "div.tab-nav-texte",
        crossLinking: true,
        slideEaseDuration: 1000,
        slideEaseFunction: "easeInOutExpo",
        transition: "fade",
        hashURL: false
      });
    });
    
    
    $(".gototop a").click(function(){
      jQuery("html, body").animate({scrollTop:0}, 500);
      return false;
    });
    
    
    
    
    //hdswitch jQuery UI widget
    var hdswitch = $(".hdswitch");
    hdswitch.hdswitch();

    //versionswitcher jQuery UI widget
    var versionswitcher = $(".versionswitcher");
    versionswitcher.versionswitcher();
    
    //nav_main jQuery UI widget
    var nav_main = $(".nav_main");
    nav_main.nav_main();
    
    //mobileheader jQuery UI widget
    var mobileheader = $(".mobileheader");
    mobileheader.mobileheader(); 

    

}); //jQuery document ready