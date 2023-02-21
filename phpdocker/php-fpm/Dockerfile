FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \ 
        php8.2-bcmath \ 
        php8.2-bz2 \ 
        php8.2-cgi \ 
        php8.2-decimal \ 
        php8.2-gd \ 
        php8.2-gmp \ 
        php8.2-http \ 
        php8.2-imagick \ 
        php8.2-imap \ 
        php8.2-intl \ 
        php8.2-ldap \ 
        php8.2-mcrypt \ 
        php8.2-mysql \ 
        php8.2-odbc \ 
        php8.2-pgsql \ 
        php8.2-phpdbg \ 
        php8.2-psr \ 
        php8.2-raphf \ 
        php8.2-redis \ 
        php8.2-soap \ 
        php8.2-sqlite3 \ 
        php8.2-uuid \ 
        php8.2-xdebug \ 
        php8.2-xmlrpc \ 
        php8.2-xsl \ 
        php8.2-dom \ 
        php8.2-mbstring \ 
        php8.2-yaml; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
