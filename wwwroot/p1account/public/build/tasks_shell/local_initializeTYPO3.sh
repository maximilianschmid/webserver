#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/


#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh



# let's go
echo "CREATE TYPO3-Database"
#create Database
mysql --verbose -u$MYSQLUSER -p$MYSQLPASSWORD -h$MYSQLHOST -e "CREATE DATABASE IF NOT EXISTS \`${MYSQLDATABASE}\` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"





#Create the typo3temp-directory
echo create Directory Structure


#Create the redakteursfolder-directory
if [ -d "${DOCUMENTROOT}fileadmin/redakteursfolder" ]
then
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder exists"
else
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}fileadmin/redakteursfolder
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder created"
fi

#Create the redakteure-directory
if [ -d "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure" ]
then
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure exists"
else
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure created"
fi

#Create the redakteure-directory _recycler_
if [ -d "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure/_recycler_" ]
then
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure/_recycler_ exists"
else
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure/_recycler_ does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure/_recycler_
  echo "${DOCUMENTROOT}fileadmin/redakteursfolder/redakteure/_recycler_ created"
fi



if [ -d "${DOCUMENTROOT}typo3temp" ]
then
  echo "${DOCUMENTROOT}typo3temp exists"
else
  echo "${DOCUMENTROOT}typo3temp does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}typo3temp
  mkdir ${DOCUMENTROOT}typo3temp/ce_gallery
  mkdir ${DOCUMENTROOT}typo3temp/cs
  mkdir ${DOCUMENTROOT}typo3temp/llxml
  mkdir ${DOCUMENTROOT}typo3temp/pics
  mkdir ${DOCUMENTROOT}typo3temp/GB
  mkdir ${DOCUMENTROOT}typo3temp/temp
  echo "${DOCUMENTROOT}typo3temp and subfolders created"
fi


#Create the uploads-directory
if [ -d "${DOCUMENTROOT}uploads" ]
then
  echo "${DOCUMENTROOT}uploads exists"
else
  echo "${DOCUMENTROOT}uploads does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}uploads
  mkdir ${DOCUMENTROOT}uploads/media
  mkdir ${DOCUMENTROOT}uploads/pics
  mkdir ${DOCUMENTROOT}uploads/tf 
  echo "${DOCUMENTROOT}uploads and subfolders created"
fi



#set writeable direcories
echo "make special folders writeable by webserver"
chmod 777 ${DOCUMENTROOT}typo3temp 
chmod -R 777 ${DOCUMENTROOT}typo3temp/*
chmod 777 ${DOCUMENTROOT}uploads 
chmod -R 777 ${DOCUMENTROOT}uploads/*
chmod 777 ${DOCUMENTROOT}fileadmin
chmod -R 777 ${DOCUMENTROOT}fileadmin/*
echo "special folders are writeable by webserver"


#echo "setting user permissions"
#echo "chmod -R 777 ${DOCUMENTROOT}*"
chmod -R 777 ${DOCUMENTROOT}*
#echo "user permissions set"

echo "Restart Apache Webserver - necessary to apply vhost settings."
echo "Please enter your Password"
sudo apachectl restart


#all done
exit 0

