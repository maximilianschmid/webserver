#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh

# if browser does not connect to livereload server
# https://github.com/mockko/livereload/issues/91
# fix command: 
# > sudo gem install em-websocket

SCRIPTPATH=`dirname $0`/


FILE=~/.livereload
if [ -w $FILE ]
then
   echo "Write permission is granted on $FILE"
else
   echo "Write permission is NOT granted on $FILE"
   echo "##################################"
   echo "type in terminal:" 
   echo "sudo chmod 777 ~/.livereload"
   echo "and try again."    
   echo "##################################"
fi


# check for existence of .svg and .txt extensions in ~/.livereload global config file
if [ `grep -w -c  "config.exts << '.svg'" ~/.livereload` -gt 0 ]
then
  echo ".svg included"
else
  echo ".svg not included - adding .svg now."
  echo "config.exts << '.svg'" >> ~/.livereload
fi

if [ `grep -w -c  "config.exts << '.txt'" ~/.livereload` -gt 0 ]
then
  echo ".txt included"
else
  echo ".txt not included - adding .txt now."
  echo "config.exts << '.txt'" >> ~/.livereload
fi

if [ `grep -w -c  "config.exts << '.xml'" ~/.livereload` -gt 0 ]
then
  echo ".xml included"
else
  echo ".xml not included - adding .xm now."
  echo "config.exts << '.xml'" >> ~/.livereload
fi


cd ${DOCUMENTROOT}
echo "watching ${DOCUMENTROOT}"
livereload

# we are done
echo "Done."

#all done
exit 0