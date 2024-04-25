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

chmod 777 ${DOCUMENTROOT}build/tools/fswatch/fswatch
${DOCUMENTROOT}build/tools/fswatch/fswatch ${DOCUMENTROOT}fileadmin/app/static/js/source/ ${DOCUMENTROOT}build/tasks_shell/local_cat_javascript.sh

#all done
exit 0