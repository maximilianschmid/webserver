#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#export binary paths 
export PATH=/usr/local/mysql/bin/:$PATH

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
source ${SCRIPTPATH}inc/serversettings.sh

echo "increment build number"
${SCRIPTPATH}local_incrementRevision.sh

# check if compiled folder exists, if not create one
if [ -d "${DOCUMENTROOT}fileadmin/app/static/css/compiled" ]
then
  echo "compiled folder exists, compile with compass/sass"
else
  echo "${DOCUMENTROOT}fileadmin/app/static/css/compiled does not exist - the folder will be created"
  mkdir ${DOCUMENTROOT}fileadmin/app/static/css/compiled
fi

echo "compile SCSS to CSS"
echo ${DOCUMENTROOT}fileadmin/app/static/css
compass compile ${DOCUMENTROOT}fileadmin/app/static/css

# concatenate JavaScript files
${DOCUMENTROOT}build/tasks_shell/local_cat_javascript.sh

echo "compress JavaScript using yui compressor"
java -jar ${DOCUMENTROOT}build/tools/yuicompressor-2.4.2.jar ${JSPATH}js.all.js -o ${JSPATH}js.all.ycomp.js

echo "open http://${HOST_URL} in Firefox"
open http://${HOST_URL}


#all done
exit 0