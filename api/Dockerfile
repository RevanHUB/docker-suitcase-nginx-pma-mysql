#FROM nginx:latest
FROM ubuntu:latest
LABEL description="Servicio de Servidor Laravel en Contenedor"

# Asigno el directorio inicial a /var/www/html
WORKDIR /var/www/html

# Instala las dependencias necesarias
RUN apt-get -y update && apt-get -y upgrade

# Agrego las dependencias de ondrej para poder instalar PHP 8.2
RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php 
RUN apt update -y

# Instalo dependencias de uso para laravel y PHP
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    nano \
    curl \
    php8.2 \ 
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

# Copio todo el contenido
COPY ./api/ /var/www/html

# Refresco el vendor para que sea ejecutable en la api
#RUN composer install --no-plugins

# Ejecuto las migraciones
#RUN php artisan migrate:fresh 

# Entrypoint provisional (es un bucle)
ENTRYPOINT ["sh", "-c", "tail -f /dev/null & pid=$!; trap 'kill $pid' SIGINT; wait"]

# Entrypoint de deploy
#ENTRYPOINT ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]

EXPOSE 8000

