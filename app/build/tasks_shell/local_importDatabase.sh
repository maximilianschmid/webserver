#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh


# let's go
echo "Start Import of Entire Typo3-Database"

#do the local import
mysql --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST $MYSQLDATABASE -P 3306 < $SQLFILE





#all done
exit 0
