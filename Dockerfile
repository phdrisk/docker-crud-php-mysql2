FROM phdrisk/dockers:latest
RUN docker-php-ext-install mysqli
WORKDIR /var/www/html
CMD composer install 

