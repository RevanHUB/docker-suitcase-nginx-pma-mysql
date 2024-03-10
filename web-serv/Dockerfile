# Usa la imagen base de httpd
FROM ubuntu:latest

# Instala las dependencias necesarias
RUN apt-get -y update && apt-get -y upgrade


# Instalo apache 
RUN apt install -y apache2

# Agrego las dependencias de ondrej para poder instalar PHP 8.2
RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php 
RUN apt update -y

# Actualiza el sistema y luego instala las dependencias necesarias
RUN apt-get install -y --no-install-recommends \
    libbz2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    unzip \
    zip 

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

# Habilitar manualmente el módulo de reescritura de Apache
#RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

# Habilita los módulos de Apache necesarios
#RUN a2enmod rewrite

# Instala PHP
#RUN apt-get install -y \
#    php \
#    php-cli \
#    php-bz2 \
#    php-mbstring \
#    php-mysqli \
#    php-pdo \
#    php-openssl \
#    php-zip \
#    php-curl

# Instala Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias necesarias para desarrollo (por si se incluye en futuras
# updates o se necesita su uso con node)
#RUN apt-get install -y nodejs

# Instalamos repositorio de npm (comentado por seguridad de momento)
#RUN apt-get install npm

#Genero una clave para artisan 
#CMD ["php", "artisan", "key:generate"]
# Instalamos repositorio de composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod php8.2 
#COPY /www /usr/local/apache2/htdocs
#RUN cd /var/www/html
#CMD ["php", "artisan", "migrate:fresh", "--seed"]
# Ejecuta el comando php artisan serve al iniciar el contenedor
#CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]

ENTRYPOINT ["sh", "-c", "tail -f /dev/null & pid=$!; trap 'kill $pid' SIGINT; wait"]
