How to install YAML for TemplaVoila:

  1. Install TYPO3 and make sure everything works. If TYPO3 itself doesn't work properly, this template won't help you...
  
  2. Adjust TYPO3 to use utf-8 encoding. Either use the Install-Tool or manually add the following lines
  
     $TYPO3_CONF_VARS['BE']['forceCharset'] = 'utf-8';
     $TYPO3_CONF_VARS['SYS']['setDBinit'] = 'SET NAMES utf8';
     
     to the file typo3conf/localconf.php
     
  3. Extract the file fileadmin.zip und upload its content to your server.
  
  4. Install this extension. It will automatically inform you about missing mandatory extensions and also try to install them automatically.
  
  5. Import one of the provided t3d Files. If you don't do that, there are no Datastructures (DS) and Templateobjects (TO) for TemplaVoila and nothing can be displayed.
  
Your are done.
