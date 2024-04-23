#!/bin/sh

# Maximilian Schmid - Januar 2009
# ShellScriptingHowTo
# http://www.ooblick.com/text/sh/
# http://www.freeos.com/guides/lsst/

SCRIPTPATH=`dirname $0`/

${SCRIPTPATH}../../../../build/tasks_shell/_incrementRevision.sh

# check if compiled folder exists, if not create one
if [ -d "${SCRIPTPATH}compiled" ]
then
  echo "compiled folders exists, start watching..."
else
  echo "${DOCUMENTROOT}compiled does not exist - the folder will be created"
  mkdir ${SCRIPTPATH}compiled
fi

# watch .scss-files
compass watch ${SCRIPTPATH}


# we are done
echo "Done."

#all done
exit 0