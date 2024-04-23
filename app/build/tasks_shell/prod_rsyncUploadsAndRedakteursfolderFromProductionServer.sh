#!/bin/sh

# Maximilian Schmid - Jul 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



# we are done
#echo "\n\n !!! Production Server deployed - no more push to production server database !!!\n\n"
#all done
#exit 0


echo "rsync /fileadmin/redakteursfolder/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}fileadmin/redakteursfolder/ ${DOCUMENTROOT}fileadmin/redakteursfolder/ 
echo "rsync /uploads/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}uploads/ ${DOCUMENTROOT}uploads/ 



#all done
#exit 0