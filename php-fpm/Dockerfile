FROM php:8.2-fpm-alpine 

# Instalo los prerequisitos
RUN apk update && \
    apk add git && \
    apk add unzip
	
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer	

COPY ./nginx/www/ /var/www/html

# Descargo composer
RUN composer create-project --prefer-dist laravel/laravel /var/www/html/

WORKDIR /var/www/html

# Arregla el error permiso denegado
RUN chown -R www-data:www-data /var/www/html
RUN chmod 755 -R www-data:www-data /var/www/html
CMD ["php-fpm", "-F"]