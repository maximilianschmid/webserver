/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */


//create own jQuery namespace to not conflict with existing JS-Code on page
// defined in galleria-1.2.3.js to assign the correct jQuery to galleria
//var jQuery_pangallery = $.noConflict(true);


(function($) {
  //document ready, let's go
  $(document).ready(function(){
    //this $(document).ready() conflicts with the admin_panel, so I moved the initialization code to the $(document).ready() in anorak.unobtrusive.js
    // not nice, but works
    debug("aio_feedit JS executed");
    //enable FE-Edit here to avoid conflict with admin panel
    if ($(".frontEndEditIconLinks").size() > 0){
       $(".feedit_bar").feedit();
    } 
  });
})(jQuery_aio_feedit);




(function($){
    $.fn.feedit = function(options){
        // build main options before element iteration
        var opts = $.extend({},
        $.fn.feedit.defaults, options);
        // iterate and reformat each matched element
        return this.each(function(){
            var feedit = $(this);

            // build element specific options
            var o = $.meta ? $.extend({},
            opts, feedit.data()) : opts;

            cookieDomain = $.fn.aio_getcookiedomain();
            
            //store current URL in cookie for returnURL in Templavoila
            $.cookie("aio_feedit_returnurl", location.href, {
              path: '/',
              domain: cookieDomain
            });
                
            var t3backendurl = "//" + cookieDomain + "/typo3/";
            
            //get pageid
            function getPageID(){
              var classes = $("body").attr("class").split(" ");
              for (x in classes){
                if (classes[x].substr(0, 5) === "page-"){
                  pageid = classes[x].substr(5);
                  return pageid;
                }
              }
            }
            var pageid = getPageID();

            //get getFieldName
            function getFieldName($el){
              var classes = $el.attr("class").split(" ");
              for (x in classes){
                if (classes[x].substr(0, 6) === "field_"){
                  return classes[x];
                }
              }
            }
            
            //get returnURL
            function getReturnUrl(){
              return $.cookie("aio_feedit_returnurl");
            }         
                        
            //get languageid
            var languageid = $(".aio_feedit_languageid").html();


            // check if feedit is embedded into TYPO3 Backend
            if (top.location !== location){
                //in backend
                $("body").addClass("feedit_in_backend");
            } else{
                //not in backend
                $("body").addClass("feedit_in_frontend");
            }

            //move forms inside of csc-default div
            $(".feedit-form").each(function(){
                $(this).prev(".csc-default").append($(this));
            });

            //find all csc-default content elements and add feedit-element-wrap class
            $(".csc-default").has(".feedit-form").each(function(){
                var contentElement = $(this);

                contentElement.addClass("feedit-element-wrap");
                
                //check for subcolumn element
                if (contentElement.has(".subcolumns").size() > 0){
                  contentElement.addClass("feedit-element-wrap-subcolumns");
                }


                //tt_news handling
                if (contentElement.find(".news-list-container").size() > 0){
                    contentElement.addClass("feedit-element-wrap-subcolumns");
                    contentElement.find(".news-list-item").each(function(){
                        $(this).append( $(this).find(".feedit-form") );
                        $(this).addClass("feedit-element-wrap");
                    });
                }
                if (contentElement.find(".news-latest-container").size() > 0){
                    contentElement.addClass("feedit-element-wrap-subcolumns");
                    contentElement.find(".news-latest-item").each(function(){
                        $(this).append( $(this).find(".feedit-form") );
                        $(this).addClass("feedit-element-wrap");
                    });
                }
                
                if (contentElement.find(".news-single-item").size() > 0){
                    contentElement.find(".news-single-item").each(function(){
                        $(this).addClass("feedit-element-wrap");
                        $(this).parent().find("> .feedit-form").remove();
                    });
                }
                //tt_news handling end
                
            });//find all csc-default content elements and add feedit-element-wrap class

            
            //loop through all .field content fields and create new item buttons
            var newBaseURL ="//"+window.location.host+"/typo3conf/ext/templavoila/mod1/db_new_content_el.php?";
            $(".field").each(function(){
                var field = $(this);
                
                //if before, than position == 0
                // 1) check for parent record
                // parentRecord=tt_content:524
                // 2) check for field
                // 3) check for position id
                // 4) get returnURL
 
                if ( field.parent().parent().hasClass("subcolumns") ){
                  //we are in a subcomlumns element
                  parentRecord = "tt_content:"+field.parent().parent().parent().attr("id").substr(1);
                }else{
                  //we are on a page layout field itself
                  parentRecord = "pages:"+getPageID();
                }
                //build newURL
                var positionID = "0";
                parentRecord = parentRecord+":sDEF:lDEF:"+ getFieldName(field) +":vDEF:"+ positionID;
                var newURL = newBaseURL+"id="+getPageID()+"&parentRecord="+parentRecord + "&returnUrl="+getReturnUrl();
                field.prepend("<a class='newitem_button' href='"+newURL+"'><span>new link before: "+  newURL +"</span></a>");
                
                //now loop through all .feedit-element-wrap and add new button after each
                field.find("> .feedit-element-wrap").each(function(){
                  var contentElement = $(this);
                  //if after, then find out position index
                  if ( contentElement.parent().parent().parent().hasClass("subcolumns") ){
                    //we are in a subcomlumns element
                    parentRecord = "tt_content:"+contentElement.parent().parent().parent().parent().attr("id").substr(1);
                  }else{
                    //we are on a page layout field itself
                    parentRecord = "pages:"+getPageID();
                  }
                  //build newURL
                  var positionID = (contentElement.index()+1) / 2;
                  parentRecord = parentRecord+":sDEF:lDEF:"+ getFieldName(field) +":vDEF:"+ positionID ;
                  var newURL = newBaseURL+"id="+getPageID()+"&parentRecord="+parentRecord + "&returnUrl="+getReturnUrl();
                  contentElement.after("<a class='newitem_button' href='"+newURL+"'><span>new link after: "+ newURL +"</span></a>");
                });//now loop through all .feedit-element-wrap end
                
            });//loop through all .field content fields and create new item buttons
            

            //exclude .feedit-element-wrap items in footer
            $(".footer .feedit-element-wrap").removeClass("feedit-element-wrap");

            //remove the feedit new button
            $(".feedit-element-wrap").each(function(){
                var contentElement = $(this);
                if ( contentElement.hasClass("news-list-item") || contentElement.hasClass("news-latest-item") || contentElement.hasClass("news-single-item") ){
                  //
                }else{
                  contentElement.find(".feedit-form a.new:last").remove();
                }
            });//remove the feedit new button


            //find all feedit-element-wrap elements and add show/hidden status
            $("a.unhide").each(function(){
                var contentElement = $(this).parents(".feedit-element-wrap:first");
                contentElement.addClass("feedit-element-wrap-hidden");
            });//find all feedit-element-wrap elements and add show/hidden status
            
            //find all a.hide buttons and remove JavaScript confirmation code
            $(".feedit-element-wrap a.hide").each(function(){
                var l = $(this);
                var attr =  l.attr("onclick");
                var newattr = attr.slice( attr.indexOf('{')+1, attr.indexOf('}')) + "return false;";
                l.attr("onclick", newattr);
            });

            //find all a.delete buttons and change JavaScript confirmation message
            $(".feedit-element-wrap a.delete").each(function(){
                var l = $(this);
                var attr =  l.attr("onclick");
                var newattr = attr.replace("confirm('Diesen Datensatz tats&#xe4;chlich l&#xf6;schen?')", "confirm('Möchten Sie den Inhalt tatsächlich löschen?')"  );
                l.attr("onclick", newattr);
            });


            // feedit - global behaviour   
            feedit.bind("enableEdit",
            function(){
              $.cookie("feedit-enabled", "true", {
                  path: '/',
                  domain: cookieDomain
              });
              //automatically enable/disable showHiddenPages with enable/disable feedit
              if ( get_showhiddenpages_status() === false ){
                show_showhide_hiddenpages();
              }
              //automatically enable/disable showHiddenContent with enable/disable feedit
              if ( get_showhiddencontent_status() === false ){
                show_showhide_hiddencontent();
              }
              submitAdminPanelForm();
            });


            // disableedit event 
            feedit.bind("disableEdit",
            function(){
              $.cookie("feedit-enabled", "false", {
                path: '/',
                domain: cookieDomain
              });
              //automatically enable/disable showHiddenPages with enable/disable feedit
              if ( get_showhiddenpages_status() === true ){
                hide_showhide_hiddenpages();
              }
              //automatically enable/disable showHiddenContent with enable/disable feedit
              if ( get_showhiddencontent_status() === true ){
                hide_showhide_hiddencontent();
              }
              submitAdminPanelForm(); 
            });

            // enableedit event on init()  
            feedit.bind("init_enableEdit",
            function(){
                $("body").addClass("feedit-enabled");
                activateHover();
                $(".contact_data .contact_edit_link").show();
            });


            // disableedit event on init()
            feedit.bind("init_disableEdit",
            function(){
                $("body").removeClass("feedit-enabled");
                deactivateHover();
                $(".contact_data .contact_edit_link").hide();
            });
            

            function initFeeditOnOffButton(){
              var l = $(".feedit_on_off_switch");
              //check for state stored in cookie
              if ($.cookie("feedit-enabled") != "false"){
                //on   
                l.addClass("enabled");
                l.removeClass("disabled");
                  
              } else{
                //off
                l.addClass("disabled");
                l.removeClass("enabled");
              }
            }
            
            // called on logout
            feedit.bind("remove", function(){
              feedit.trigger("disableEdit");
              feedit.slideUp();
              $("body").animate({ "marginTop": "0"});
              $(".contact_data .contact_edit_link").remove();
            });


            $(".feedit_on_off_switch").click(function(){
              var l = $(this);
              if ( l.hasClass("enabled") ){
                feedit.trigger("disableEdit");
              } else{
                feedit.trigger("enableEdit");
              }
              return false;
            });


            //prevent e.g. clickitem() from executing by preventing event bubbling (via return false)
            $(".typo3-editPanel a").click(function(){
              window.location.href = $(this).attr("href");
              return false;
            });


            //add hover event handlers to content elements
            function activateHover(){
              $(".feedit-element-wrap").live("mouseover", function(e){
                  hoverToggle(e, $(this));
              });
              $(".feedit-element-wrap").live("mouseout", function(e){
                  hoverToggle(e, $(this));
              });
            }
            
            function deactivateHover(){
                $(".feedit-element-wrap").unbind("hover");
            }
            
            function hoverToggle(e, t){
              if ( e.type === "mouseout" || e.type === "mouseleave" ){
                // do something on mouseout
                t.removeClass("feedit-element-wrap-hover");               
              } else{
                // do something on mouseover
                t.addClass("feedit-element-wrap-hover");
              }
            }
            
            
            function getActiveStatus(){
              return $(".feedit_on_off").hasClass("enabled");
            }

            //double click edit
            $('.feedit-element-wrap').dblclick(function(){
              if (getActiveStatus()){
                //make sure to trigger first a.edit - second a.edit is usually for the wrapper element
                $(this).find(".feedit-form a.edit:first").trigger("click");
              }
            });


            //ensure noView if page is in single tab opened - &noView=1
            $("a.frontEndEditIconLinks").each(function(){
                $(this).attr("href", $(this).attr("href") + "&noView=1");
            });
            $(".feedit_bar a.edit_page").each(function(){
                $(this).attr("href", $(this).attr("href") + "&noView=1");
            });



            //logout button behaviour
            feedit.find(".logout").click(function(){
                $.ajax({
                    url: $(this).attr("href"),
                    success: function(){
                        //reload page
                        //window.location.reload()
                        feedit.trigger("remove");
                        remove_typo3_previewInfo();
                    }
                });
                return false;
            });
            
            
            feedit.find("a").click(function(){
              activateTemplavoilaModus();
            });
            

            deactivateTemplavoilaModus();
            function deactivateTemplavoilaModus(){
              $.cookie("templavoila-feedit-modus", "false", {
                  path: '/',
                  domain: cookieDomain
              });   
            }

            function activateTemplavoilaModus(){
              $.cookie("templavoila-feedit-modus", "true", {
                  path: '/',
                  domain: cookieDomain
              });
            }  


            //new functionality
            newcontentelement = $(".typo3-editPanel a.new").filter(function(index) {
              /*
               * exclude the following elements from the new item position marker
               * .news-single-item
               * .news-single-item
               * .news-single-item
               */
              if ( $(this).parents(".news-latest-container").size() > 0 || $(this).parents(".news-list-container").size() > 0 || $(this).parents(".news-single-item").size() > 0 ){
                return false;
              }else{
                return true;
              }
            });
            
            newcontentelement.hover(function(){
              $(this).parents(".feedit-element-wrap").after("<div class='csc-default-newmarker'>Das neue Inhaltselement wird hier eingefügt.</div>");
            },
            function(){
              $(this).parents(".feedit-element-wrap").next().remove();
            });
              
              
           //if workspace with name "Entwurfs-Arbeitsumgebung" is in preview mode  
           if ( $('#typo3-previewInfo:contains("Entwurfs-Arbeitsumgebung")').length ){
              //preview link
              //http://www.anorak-typo3.io.local/typo3/mod.php?tx_workspaces_web_workspacesworkspaces[action]=index&tx_workspaces_web_workspacesworkspaces[controller]=Tx_Workspaces_Controller_PreviewController&tx_workspaces_web_workspacesworkspaces[controller]=Preview&M=web_WorkspacesWorkspaces&id=23
              var previewlink = feedit.find(".button.preview_page");
              
              //single page workspace preview mode
              //previewlink.attr("href", previewlink.attr("href")+ "&ADMCMD_previewWS=1");
              
              //compare workspaces preview mode
              previewlink.attr("href", "/typo3/mod.php?tx_workspaces_web_workspacesworkspaces[action]=index&tx_workspaces_web_workspacesworkspaces[controller]=Tx_Workspaces_Controller_PreviewController&tx_workspaces_web_workspacesworkspaces[controller]=Preview&M=web_WorkspacesWorkspaces&id="+getPageID()+ "&L="+languageid);
            }//#typo3-previewInfo
            
            

            //implement show hidden pages button
            //initialize button status
            if ( get_showhiddenpages_status() ){
              $(".button.showhiddenpages span").text("Versteckte Seiten aus");
            }else{
              $(".button.showhiddenpages span").text("Versteckte Seiten ein");
            }

            function get_showHiddenPagesCheckbox(){
              var showHiddenPagesCheckbox =  $(".typo3-adminPanel input[ name='TSFE_ADMIN_PANEL[preview_showHiddenPages]'][ type='checkbox'] ");
              return showHiddenPagesCheckbox;
            }
            
            function get_showhiddenpages_status(){
              if ( get_showHiddenPagesCheckbox().attr("checked") === "checked" ){
                return true;
              }else{
                return false;
              }
            }
            
            function toggle_showhide_hiddenpages(){
              if ( get_showHiddenPagesCheckbox().attr("checked") === "checked" ){
                get_showHiddenPagesCheckbox().removeAttr("checked");
              }else{
                get_showHiddenPagesCheckbox().attr("checked", "checked");
              }
            }

            function show_showhide_hiddenpages(){
              get_showHiddenPagesCheckbox().attr("checked", "checked");
            }

            function hide_showhide_hiddenpages(){
              get_showHiddenPagesCheckbox().removeAttr("checked");
            }

            $(".button.showhiddenpages").click(function(){
              toggle_showhide_hiddenpages();
              return false;
            });
            

            

            //implement show hidden contentelement button
            //initialize button status
            if ( get_showHiddenContentCheckbox() ){
              $(".button.showhiddencontent span").text("Versteckte Inhalte aus");
            }else{
              $(".button.showhiddencontent span").text("Versteckte Inhalte aus");
            }

            function get_showHiddenContentCheckbox(){
              var showHiddenContentCheckbox =  $(".typo3-adminPanel input[ name='TSFE_ADMIN_PANEL[preview_showHiddenRecords]'][ type='checkbox'] ");
              return showHiddenContentCheckbox;
            }
            
            function get_showhiddencontent_status(){
              if ( get_showHiddenContentCheckbox().attr("checked") === "checked" ){
                return true;
              }else{
                return false;
              }
            }
            
            function toggle_showhide_hiddencontent(){
              if ( get_showHiddenContentCheckbox().attr("checked") === "checked" ){
                get_showHiddenContentCheckbox().removeAttr("checked");
              }else{
                get_showHiddenContentCheckbox().attr("checked", "checked");
              }
            }

            function show_showhide_hiddencontent(){
              get_showHiddenContentCheckbox().attr("checked", "checked");
            }

            function hide_showhide_hiddencontent(){
              get_showHiddenContentCheckbox().removeAttr("checked");
            }

            $(".button.showhiddencontent").click(function(){
              toggle_showhide_hiddencontent();
              return false;
            });

            
            function submitAdminPanelForm(){
              //submit admin panel form
              // first strip hash value from form action
              var formaction = $("#TSFE_ADMIN_PANEL_FORM").attr("action");
              var formactionarray = formaction.split("#");
              $("#TSFE_ADMIN_PANEL_FORM").attr("action", formactionarray[0]);
              // then submit
              $("#TSFE_ADMIN_PANEL_FORM").submit();
            }
           
           
           
            //adopt body margin-top according to height of feedit_bar
            $(window).resize(function() {
              adjustBodyTopMargin();
              position_typo3_previewInfo();
            });
             
            adjustBodyTopMargin();
            function adjustBodyTopMargin(){
              $("body").css("margin-top", $(".feedit_bar").outerHeight()+"px");
            }
             
            position_typo3_previewInfo();
            function position_typo3_previewInfo(){
              var typo3_previewInfoPosition = $(".feedit_bar").outerHeight()+30;
              $("#typo3-previewInfo").css("top", typo3_previewInfoPosition+"px");
            }
             
            function remove_typo3_previewInfo(){
              $("#typo3-previewInfo").remove();
            }
       
            
            //initial settings on page load / initializing feedit
            function init(){
              // .feedit content elements behaviours
              //check for FE-Edit enabled
              if ($(".frontEndEditIconLinks").size() > 0){
                //check for cookie
                if ($.cookie("feedit-enabled") === "false"){
                  //off
                  feedit.trigger("init_disableEdit");
                } else{
                  //on
                  feedit.trigger("init_enableEdit");
                }
              }
              initFeeditOnOffButton();
            }
            init();
           
        });//each()
    };

})(jQuery_aio_feedit);
