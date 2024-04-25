#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh


# let's go
echo "Start Export of entire Typo3-Database"

#truncate cache-tables
${SCRIPTPATH}local_clearAllCache.sh

#do the local export
echo "Dump Typo3-Database:"
mysqldump --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE > $SQLFILE





#all done
exit 0