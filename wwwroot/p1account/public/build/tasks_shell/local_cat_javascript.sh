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

# if you want to ensure that TYPO3 doesn't cache anything
#./local_clearAllCache.sh

echo "concatenate JavaScript files"
cat \
    ${JSPATH}source/libs/_baselib/jquery.js \
    ${JSPATH}source/libs/_baselib/jquery.animate-enhanced.js \
    ${JSPATH}source/libs/_baselib/global.js \
    ${JSPATH}source/libs/_baselib/modernizr.js \
    ${JSPATH}source/libs/_baselib/modernizr.addtest.js \
    ${JSPATH}source/libs/_baselib/jquery.mousewheel.js \
    ${JSPATH}source/libs/_baselib/jquery.cookie.js \
    ${JSPATH}source/libs/_baselib/jquery.easing.js \
    ${JSPATH}source/libs/_baselib/jquery.ba-bbq.js \
    ${JSPATH}source/libs/_baselib/jquery.mobile.event.js \
    ${JSPATH}source/libs/_baselib/jquery.mobile.vmouse.js \
    ${JSPATH}source/libs/_baselib/jquery.ui.core.js \
    ${JSPATH}source/libs/_baselib/jquery.ui.widget.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.nav_main.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.mobileheader.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.clickitem.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.stickylink.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.codaslider.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.codasliderTouchify.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.fancybox.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.fancyboxTouchify.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.hdswitch.js \
    ${JSPATH}source/libs/jqueryplugins/jquery.versionswitcher.js \
    ${JSPATH}source/anorak.unobtrusive.js \
> ${JSPATH}js.all.js

#all done
exit 0