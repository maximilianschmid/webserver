#!/bin/sh

# Maximilian Schmid - Februar 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh


echo "UPDATE SOURCE"
SOURCEPATH=/extendedbrain/wwwroot/anorakio-typo3/
rs ${SOURCEPATH}index.php ${SCRIPTPATH}../index.php
rs ${SOURCEPATH}t3lib/ ${SCRIPTPATH}../t3lib/
rs ${SOURCEPATH}typo3/ ${SCRIPTPATH}../typo3/
rs ${SOURCEPATH}TYPO3_SOURCE.log ${SCRIPTPATH}../TYPO3_SOURCE.log

#all done
exit 0