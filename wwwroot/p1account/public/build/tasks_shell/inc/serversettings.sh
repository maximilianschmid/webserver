#!/bin/sh

# Maximilian Schmid - Aug 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

# SET BASH ALIASES
alias rs="rsync -av --delete --progress --exclude=.svn --exclude=.git --exclude=.sass-cache"

#Include global secure password file (check for existence before inclusion):
if [ -f /Volumes/truecrypt/passwd/passwd ]
then
source /Volumes/truecrypt/passwd/passwd
fi


#Basic
DOCUMENTROOT=${SCRIPTPATH}../../
JSPATH=${DOCUMENTROOT}fileadmin/app/static/js/
DOMAIN=physiotherapie-huber.at

RSYNCOPTIONS="-av --exclude=.svn --exclude=.git --exclude=.sass-cache --exclude=temp_CACHED_* --progress"

#Localhost Server Variables
HOST_URL=www.${DOMAIN}.local
MYSQLHOST=127.0.0.1
MYSQLUSER=root
MYSQLPASSWORD=password
MYSQLDATABASE=typo3_physiotherapiehuber
SQLFILE=${DOCUMENTROOT}db/local.sql


#Production Server Variables
USERNAME_PRODUCTIONSERVER=p145775
PRODUCTIONSERVER_TYPO3PATH=/html/typo3/
HOST_URL_PRODUCTIONSERVER=${USERNAME_PRODUCTIONSERVER}.mittwaldserver.info
MYSQLHOST_PRODUCTIONSERVER=db1226.mydbserver.com
MYSQLUSER_PRODUCTIONSERVER=${USERNAME_PRODUCTIONSERVER}d1
MYSQLPASSWORD_PRODUCTIONSERVER=${WWWPHYSIOTHERAPIEHUBERAT_MYSQLPASSWORD_PRODUCTIONSERVER}
MYSQLDATABASE_PRODUCTIONSERVER=usr_${USERNAME_PRODUCTIONSERVER}_2
SQLFILE_PRODUCTIONSERVER=${DOCUMENTROOT}db/production.sql

#SSH Production Server
HOSTNAME_PRODUCTIONSERVER=${USERNAME_PRODUCTIONSERVER}.mittwaldserver.info
#uncomment the cat line and execute serversettings.sh to copy key to production server
#cat /Volumes/truecrypt/ssh/www.anorak.io.pub | ssh ${USERNAME_PRODUCTIONSERVER}@${USERNAME_PRODUCTIONSERVER}.mittwaldserver.info 'cat>>.ssh/authorized_keys'
SSHKEYFILE_PRODUCTIONSERVER=~/.ssh/www.anorak.io


#Staging Server Variables
HOST_URL_STAGINGSERVER=${DOMAIN}.staging.anorak.io
PATH_STAGINGSERVER=/html/physiotherapie-huber/
MYSQLUSER_STAGINGSERVER=
MYSQLPASSWORD_STAGINGSERVER=
MYSQLHOST_STAGINGSERVER=
MYSQLDATABASE_STAGINGSERVER=
SQLBACKUPFILE_STAGINGSERVER=${DOCUMENTROOT}db/staging.sql

#SSH Staging Server
USERNAME_STAGINGSERVER=p113849
HOSTNAME_STAGINGSERVER=staging.anorak.io
#copy key to staging server command
#cat /Volumes/truecrypt/ssh/www.anorak.io.pub | ssh p113849@p113849.mittwaldserver.info 'cat>>.ssh/authorized_keys'
SSHKEYFILE_STAGINGSERVER=/Volumes/truecrypt/ssh/staging.anorak.io
