FROM php:8.2-apache
LABEL description="Servicio de Servidor Web Apache2 en Contenedor"

# Instala las dependencias necesarias


# Instala las dependencias necesarias para desarrollo (por si se incluye en futuras
# updates o se necesita su uso con node)
#RUN apt-get install -y nodejs

# Instalamos repositorio de npm (comentado por seguridad de momento)
#RUN apt-get install npm

#Genero una clave para artisan 
#CMD ["php", "artisan", "key:generate"]
# Instalamos repositorio de composer
RUN mkdir /usr/local/bin/composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY /www /var/www/html
#CMD ["php", "artisan", "migrate:fresh", "--seed"]
# Ejecuta el comando php artisan serve al iniciar el contenedor
#CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]


