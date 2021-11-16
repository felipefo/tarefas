FROM gitpod/workspace-full:latest


# optional: use a custom apache config.
COPY apache.conf /etc/apache2/apache2.conf

RUN apt-get update && \
    docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ &&\
    docker-php-ext-install gd

# optional: change document root folder. It's relative to your git working copy.
ENV APACHE_DOCROOT_IN_REPO="www"
