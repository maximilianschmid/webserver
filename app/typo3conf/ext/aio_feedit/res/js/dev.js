


            
            //add new content element icons in frontend
           /*
            * problems so far:
            * 1) correct redirects after TV-Form save, view, close etc.
            * 2) db_new.php -> would have to hack TYPO3 core
            */ 
           

            //get html-code from templavoila backend
            var tvbackendform = "/typo3conf/ext/templavoila/mod1/index.php?id="+pageid+"&updatePageTree=1&feedit=1";
            $.ajax({ 
              url: tvbackendform, 
              context: document.body, 
              dataFilter:function(data){
                return $(data).find('#typo3-inner-docbody .field');
              },
              success: function(data){
                //debug(data);
                
                //http://stackoverflow.com/questions/2668275/jquery-check-if-element-has-a-class-begining-with-some-string  
                /*.filter(function(){
                  var classes = this.className.split(/\s/);
                  for (var i = 0, len = classes.length; i < len; i++) 
                    if (/^field_/.test(classes[i])){
                      return true;
                    }else{
                      return false;
                    }
                })*/
                
                jQuery("body").append("<div class='ajaxtemp' style='display:none'></div>");
                jQuery(".ajaxtemp").html(data);
                                
                jQuery(".ajaxtemp").find(".field").each(function(){

                  debug( jQuery(this).find(".tpm-new") );
                  
                  jQuery(".field_maincontent").append( jQuery(this).find(".tpm-new").attr("href", "/typo3conf/ext/templavoila/mod1/"+jQuery(this).find(".tpm-new").attr("href")+"&ajax=1") );
                  
                  
                  jQuery(".tpm-new").css("border", "1px solid blue");                  
                });
            }});

            
            
            /**
             * algorithm
             * 1. find content elements in tv-htmlcode
             *    - if no content element found, grab the .tmp-new icon and place it
             * 2. checkout id of content element in tv-htmlcode
             * 3. find preceding and following .tmp-new icon
             * 4. place icon before/after content element in webpage
             * 
             */