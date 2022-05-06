FROM php:7.4-apache
RUN apt-get update
RUN apt-get install curl
RUN apt-get install nano
#RUN apt-get install -y git
RUN apt-get install zip -y
# Install unzip utility and libs needed by zip PHP extension
RUN apt-get update && apt-get install -y \
zlib1g-dev \
libzip-dev \
unzip
RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql
COPY ./cicd/container-images/php/000-default.conf /etc/apache2/sites-available
RUN a2enmod rewrite
RUN service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv /var/www/html/composer.phar /usr/local/bin/composer.phar
RUN ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN mkdir -p /var/www/html/Shop/Schokotech/
WORKDIR /var/www/html/Shop/Schokotech/

COPY . .
#RUN chown -R 1001:1001 SetUp/SetUp.sh
#USER 1001

RUN chmod +x SetUp/SetUp.sh
#RUN composer install
#RUN chown -R www-data:www-data /var/www/html/

#ENTRYPOINT ["sleep", "100000000"]
#RUN chown -R www-data:www-data /var/www/html/

