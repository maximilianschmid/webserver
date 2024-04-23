#!/bin/sh

# Maximilian Schmid - Jul 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh

# List of patched files
PATCHEDFILES=(typo3/sysext/cms/tslib/class.tslib_fe.php)

for i in "${PATCHEDFILES[@]}"
do
  echo "Upload Patched File " $i
  rsync $RSYNCOPTIONS $RSYNCOPTIONS_FIRSTDEPLOY -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}$i ${HOSTNAME_PRODUCTIONSERVER}:${TYPO3PATH_PRODUCTIONSERVER}$i
done