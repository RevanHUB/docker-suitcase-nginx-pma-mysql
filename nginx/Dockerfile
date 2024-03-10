FROM nginx:latest
LABEL description="Servicio de Servidor Web NginX en Contenedor"

# Instala las dependencias necesarias
RUN apt-get  -y update && apt-get -y upgrade
# Instalo dependencias de uso 
RUN apt-get install -y \
    nano \
    php \ 
    php-xml \ 
    php-curl \
    php-mbstring \
    php-cli \
    php-cgi \
    php-mysql 



# Instala las dependencias necesarias para desarrollo (por si se incluye en futuras
# updates o se necesita su uso con node)
RUN apt-get install -y nodejs

# Instalamos repositorio de npm (comentado por seguridad de momento)
#RUN apt-get install npm


# Descargo composer	
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer	


WORKDIR /var/www/html
#RUN composer install --no-plugins
RUN cd /var/www/html
#COPY ./api/ /var/www/html
#RUN php artisan migrate:fresh 

EXPOSE 80

