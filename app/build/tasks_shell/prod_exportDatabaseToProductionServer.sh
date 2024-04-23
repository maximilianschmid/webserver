#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



# we are done
echo "\n\n !!! Production Server deployed - no more push to production server database !!!\n\n"
#all done
exit 0


# First do a backup of Production Server!
# empty production server caches
echo "Empty production server caches caches"
${SCRIPTPATH}prod_clearAllCache.sh
echo "Backup Productive Server"
mysqldump --verbose -u$MYSQLUSER_PRODUCTIONSERVER -p$MYSQLPASSWORD_PRODUCTIONSERVER -h$MYSQLHOST_PRODUCTIONSERVER $MYSQLDATABASE_PRODUCTIONSERVER > $SQLFILE_PRODUCTIONSERVER


	
# let's go
echo "Start Export of Entire Typo3-Database from Localhost to Productive Server"
#empty local caches
${SCRIPTPATH}local_clearAllCache.sh
#local dump
mysqldump --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE > $SQLFILE
#export to Production Server
mysql --verbose -u$MYSQLUSER_PRODUCTIONSERVER -p$MYSQLPASSWORD_PRODUCTIONSERVER -h$MYSQLHOST_PRODUCTIONSERVER $MYSQLDATABASE_PRODUCTIONSERVER < $SQLFILE




#all done
exit 0