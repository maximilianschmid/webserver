#!/bin/sh

# Maximilian Schmid - September 2010
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh

sh ${SCRIPTPATH}prod_clearPageCache.sh

wget -m -nd -nH --delete-after $HOSTNAME_PRODUCTIONSERVER


#all done
exit 0