#!/bin/sh

# Maximilian Schmid - August 2011
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

#include serversettings.sh
SCRIPTPATH=`dirname $0`/
JSPATH=${SCRIPTPATH}

cat \
    ${JSPATH}jquery.js \
    ${JSPATH}feedit.lib.js \
    ${JSPATH}jquery.feedit.js \
> ${JSPATH}feedit.all.js

#all done
exit 0