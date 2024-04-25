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


echo "rsync /fileadmin/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}fileadmin/ ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}fileadmin/
echo "rsync /typo3conf/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}typo3conf/ ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}typo3conf/
echo "rsync /uploads/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}uploads/ ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}uploads/
echo "rsync /t3lib/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER" ${DOCUMENTROOT}t3lib/ ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}t3lib/
echo "rsync /typo3/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}typo3/ ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}typo3/

echo "rsync .htaccess crossdomain.xml robots.txt humans.txt"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_PRODUCTIONSERVER -i $SSHKEYFILE_PRODUCTIONSERVER $EXCLUDE" ${DOCUMENTROOT}.htaccess ${DOCUMENTROOT}crossdomain.xml ${DOCUMENTROOT}robots.txt ${DOCUMENTROOT}humans.txt ${HOSTNAME_PRODUCTIONSERVER}:${PRODUCTIONSERVER_TYPO3PATH}


echo "Show in browser"
open http://${HOST_URL_PRODUCTIONSERVER}




#all done
exit 0