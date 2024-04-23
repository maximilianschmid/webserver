#!/bin/sh

# Maximilian Schmid - Jul 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



# we are done
#echo "\n\n !!! STAGING Server deployed - no more push to STAGING server database !!!\n\n"
#all done
#exit 0


echo "rsync /fileadmin/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}fileadmin/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}fileadmin/
echo "rsync /typo3conf/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}typo3conf/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}typo3conf/
echo "rsync /uploads/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}uploads/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}uploads/
echo "rsync /t3lib/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER" ${DOCUMENTROOT}t3lib/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}t3lib/
echo "rsync /typo3/"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}typo3/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}typo3/

echo "rsync .htaccess crossdomain.xml robots.txt humans.txt index.php"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}.htaccess ${DOCUMENTROOT}crossdomain.xml ${DOCUMENTROOT}robots.txt ${DOCUMENTROOT}humans.txt ${DOCUMENTROOT}index.php ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}

echo "rsync /build"
rsync $RSYNCOPTIONS -e "ssh -l $USERNAME_STAGINGSERVER -i $SSHKEYFILE_STAGINGSERVER $EXCLUDE" ${DOCUMENTROOT}build/ ${HOSTNAME_STAGINGSERVER}:${PATH_STAGINGSERVER}build/


echo "Show in browser"
open http://${HOST_URL_STAGINGSERVER}




#all done
exit 0