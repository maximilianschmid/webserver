#!/bin/sh

# Maximilian Schmid - Feb 2011
# ShellScriptingHowTo
# https://www.freeos.com/guides/lsst/

# get scriptpath
SCRIPTPATH=`dirname $0`/

# check if cron works
touch ${SCRIPTPATH}cronlastrun

DOMAIN=anorak-typo3.io.local

# default user agent
wget -m -nd -nH --delete-after https://www.${DOMAIN}/
wget -m -nd -nH --delete-after https://pc.${DOMAIN}/
wget -m -nd -nH --delete-after https://mobile.${DOMAIN}/

# as iPhone/iPad
wget -m -nd -nH --delete-after https://www.${DOMAIN}/ -U "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16" 
wget -m -nd -nH --delete-after https://pc.${DOMAIN}/  -U "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16" 
wget -m -nd -nH --delete-after https://mobile.${DOMAIN}/  -U "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16" 

# as Android
wget -m -nd -nH --delete-after https://www.${DOMAIN}/ -U "Mozilla/ 5.0 (Linux; U; Android 2.0; en-us; sdk Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17" 
wget -m -nd -nH --delete-after https://pc.${DOMAIN}/ -U "Mozilla/ 5.0 (Linux; U; Android 2.0; en-us; sdk Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17" 
wget -m -nd -nH --delete-after https://mobile.${DOMAIN}/ -U "Mozilla/ 5.0 (Linux; U; Android 2.0; en-us; sdk Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17" 

# as Chrome9 (for high resolution images)
wget -m -nd -nH --delete-after https://www.${DOMAIN}/ -U "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13" 
wget -m -nd -nH --delete-after https://pc.${DOMAIN}/ -U "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13" 
wget -m -nd -nH --delete-after https://mobile.${DOMAIN}/ -U "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13" 

# as I8 (for low resolution images)
wget -m -nd -nH --delete-after https://www.${DOMAIN}/ -U "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)" 
wget -m -nd -nH --delete-after https://pc.${DOMAIN}/ -U "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)" 
wget -m -nd -nH --delete-after https://mobile.${DOMAIN}/ -U "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)" 


# remove robots.txt (fixes wget bug which leaves robots.txt files in the directory)
rm ${SCRIPTPATH}robots.txt*

# cron ended
touch ${SCRIPTPATH}cronended

# all done, exit with status code 0 (everything is all right)
exit 0
