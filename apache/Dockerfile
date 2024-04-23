# httpd base image
FROM httpd:2.4
# Copy the Apache virtual host configuration file to the container
COPY ./apache/apache.vhost.conf /usr/local/apache2/conf/extra/apache.vhost.conf

# Enable Apache modules to ensure proper functionality
RUN sed -i \
   # Uncomment the configuration for mod_deflate to enable compression
    -e '/#LoadModule deflate_module/s/^#//g' \
    # Uncomment the configuration for mod_proxy to enable proxying capabilities
    -e '/#LoadModule proxy_module/s/^#//g' \
    # Uncomment the configuration for mod_proxy_fcgi to enable FastCGI proxy module
    -e '/#LoadModule proxy_fcgi_module/s/^#//g' \
    # Uncomment the configuration for rewrite_module to enable rewrite module
    # https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/SystemRequirements/Index.html#apache
    -e '/#LoadModule authn_file_module/s/^#//g' \
    -e '/#LoadModule authn_core_module/s/^#//g' \
    -e '/#LoadModule authz_host_module/s/^#//g' \
    -e '/#LoadModule authz_groupfile_module/s/^#//g' \
    -e '/#LoadModule authz_user_module/s/^#//g' \
    -e '/#LoadModule authz_core_module/s/^#//g' \
    -e '/#LoadModule access_compat_module/s/^#//g' \
    -e '/#LoadModule auth_basic_module/s/^#//g' \
    -e '/#LoadModule reqtimeout_module/s/^#//g' \
    -e '/#LoadModule filter_module/s/^#//g' \
    -e '/#LoadModule mime_module/s/^#//g' \
    -e '/#LoadModule log_config_module/s/^#//g' \
    -e '/#LoadModule env_module/s/^#//g' \
    -e '/#LoadModule headers_module/s/^#//g' \
    -e '/#LoadModule setenvif_module/s/^#//g' \
    -e '/#LoadModule version_module/s/^#//g' \
    -e '/#LoadModule unixd_module/s/^#//g' \
    -e '/#LoadModule autoindex_module/s/^#//g' \
    -e '/#LoadModule dir_module/s/^#//g' \
    -e '/#LoadModule alias_module/s/^#//g' \
    -e '/#LoadModule rewrite_module/s/^#//g' \
    /usr/local/apache2/conf/httpd.conf

# Include the virtual host configuration file in the main Apache configuration
RUN echo "Include /usr/local/apache2/conf/extra/apache.vhost.conf" >> /usr/local/apache2/conf/httpd.conf
