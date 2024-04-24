FROM mysql:5.7

# Copy disable_strict_mode.cnf configuration file to the container
# https://serverpilot.io/docs/how-to-disable-strict-mode-in-mysql-5-7/
#COPY ./mysqld/etc/mysql/conf.d/disable_strict_mode.cnf /etc/mysql/conf.d/disable_strict_mode.cnf
COPY ./mysqld/etc/my.cnf /etc/my.cnf
