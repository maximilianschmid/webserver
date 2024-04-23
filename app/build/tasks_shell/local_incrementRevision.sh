#!/bin/sh

# Maximilian Schmid - September 2010
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh

#create constants_revisionnumber.txt
touch ${DOCUMENTROOT}fileadmin/app/TS-Ressources/constants_revisionnumber.txt

echo "RevisionNumber = "$( date +%Y%m%d%M%S ) > ${DOCUMENTROOT}fileadmin/app/TS-Ressources/constants_revisionnumber.txt

#create _revisionnumber.scss
touch ${DOCUMENTROOT}fileadmin/app/static/css/source/_revisionnumber.scss
echo "\$revision:"$( date +%Y%m%d%M%S )";" > ${DOCUMENTROOT}fileadmin/app/static/css/source/_revisionnumber.scss

${SCRIPTPATH}local_clearAllCache.sh

#all done
exit 0