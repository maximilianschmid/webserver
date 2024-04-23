#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



echo "Clear Cache Tables"
mysql --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE -e "
  TRUNCATE TABLE cache_extensions;
  TRUNCATE TABLE cache_hash;
  TRUNCATE TABLE cache_imagesizes;
  TRUNCATE TABLE cache_md5params;
  TRUNCATE TABLE cache_pages;
  TRUNCATE TABLE cache_pagesection;
  TRUNCATE TABLE cache_treelist;
  TRUNCATE TABLE cache_typo3temp_log;
  TRUNCATE TABLE cachingframework_cache_hash;
  TRUNCATE TABLE cachingframework_cache_hash_tags;
  TRUNCATE TABLE cachingframework_cache_pages;
  TRUNCATE TABLE cachingframework_cache_pagesection;
  TRUNCATE TABLE cachingframework_cache_pagesection_tags;
  TRUNCATE TABLE cachingframework_cache_pages_tags;
 
# clearing REAL-URL Cache makes e.g tt_news single page path unavailable!!
# to be checked out  
# do it on localhost !
  TRUNCATE TABLE tx_realurl_chashcache;
  TRUNCATE TABLE tx_realurl_errorlog;
  TRUNCATE TABLE tx_realurl_pathcache;
  TRUNCATE TABLE tx_realurl_redirects;
  TRUNCATE TABLE tx_realurl_uniqalias;
  TRUNCATE TABLE tx_realurl_urldecodecache;
  TRUNCATE TABLE tx_realurl_urlencodecache;

"

echo "Clearing typo3conf/temp_*.*"
rm ${DOCUMENTROOT}typo3conf/temp_*.*


#all done
exit 0