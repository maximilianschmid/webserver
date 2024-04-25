#!/bin/sh

# Maximilian Schmid - Januar 2009
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

SCRIPTPATH=`dirname $0`/

# watch .scss-files
compass watch ${SCRIPTPATH}


# we are done
echo "Done."

#all done
exit 0