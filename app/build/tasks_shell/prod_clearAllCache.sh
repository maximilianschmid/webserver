#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



echo "Clear Cache Tables"
mysql --verbose -u$MYSQLUSER_PRODUCTIONSERVER -p$MYSQLPASSWORD_PRODUCTIONSERVER -h$MYSQLHOST_PRODUCTIONSERVER $MYSQLDATABASE_PRODUCTIONSERVER -e "
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
"


ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $HOSTNAME_PRODUCTIONSERVER "
  echo "Clearing typo3conf/temp_*.*"
  rm ${PRODUCTIONSERVER_TYPO3PATH}typo3conf/temp_*.*
"



#all done
exit 0