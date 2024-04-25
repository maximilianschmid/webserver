#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh


echo "Import Database from production server to localhost"
echo "Empty production server caches caches"
${SCRIPTPATH}prod_clearAllCache.sh
echo "Dump Typo3-Database:"
mysqldump --verbose -u$MYSQLUSER_PRODUCTIONSERVER -p$MYSQLPASSWORD_PRODUCTIONSERVER -h$MYSQLHOST_PRODUCTIONSERVER $MYSQLDATABASE_PRODUCTIONSERVER > $SQLFILE_PRODUCTIONSERVER
echo "Import Database on localhost"
mysql --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE < $SQLFILE_PRODUCTIONSERVER


#all done
exit 0