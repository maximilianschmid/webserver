#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



# we are done
#echo "\n\n !!! Staging Server deployed - no more push to staging server database !!!\n\n"
#all done
#exit 0



# First do a backup of Staging Server!
# empty staging server caches
echo "empty staging server caches caches"
${SCRIPTPATH}staging_clearAllCache.sh
echo "Backup Staging Server"
mysqldump --verbose -u$MYSQLUSER_STAGINGSERVER -p$MYSQLPASSWORD_STAGINGSERVER -h$MYSQLHOST_STAGINGSERVER $MYSQLDATABASE_STAGINGSERVER > $SQLBACKUPFILE_STAGINGSERVER


	
# let's go
echo "Start Export of Entire Typo3-Database from Localhost to staging Server"
# empty local caches
${SCRIPTPATH}local_clearAllCache.sh
# local dump
mysqldump --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE > $SQLFILE
# export to staging Server
mysql --verbose -u$MYSQLUSER_STAGINGSERVER -p$MYSQLPASSWORD_STAGINGSERVER -h$MYSQLHOST_STAGINGSERVER $MYSQLDATABASE_STAGINGSERVER < $SQLFILE




#all done
exit 0