#!/bin/sh

# Maximilian Schmid - Januar 2009
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

SCRIPTPATH=`dirname $0`/

echo "RevisionNumber = "$( date +%Y%m%d%M%S ) > ${SCRIPTPATH}static/aio_fe-edit/constants.txt

# watch .scss-files
compass watch ${SCRIPTPATH}res/css/


# we are done
echo "Done."

#all done
exit 0