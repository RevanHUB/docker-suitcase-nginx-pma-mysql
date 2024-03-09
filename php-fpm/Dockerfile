FROM php:8-fpm-alpine 

# Instalo los prerequisitos
RUN apk update && \
    apk add git && \
    apk add unzip

# Descargo composer	
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer	

# Descargo creo un proyecto laravel
RUN composer create-project --prefer-dist laravel/laravel /var/www/html/

WORKDIR /var/www/html

# Arregla el error permiso denegado
RUN chown -R www-data:www-data /var/www/html
RUN chmod 755 /var/www/html
CMD ["php-fpm", "-F"]