FROM mysql:5.7

# Copy my.cnf configuration file to the container
COPY ./mysqld/etc/my.cnf /etc/my.cnf

# Copy init scripts (run on first startup when db/ is empty)
COPY ./mysqld/initdb.d/ /docker-entrypoint-initdb.d/
