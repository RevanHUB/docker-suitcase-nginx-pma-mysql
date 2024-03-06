FROM nginx
LABEL description="Servicio de Servidor Web NginX en Contenedor"

# Instala las dependencias necesarias
RUN apt-get  -y update && apt-get -y upgrade
RUN apt-get install -y nano
RUN apt-get install -y php8.2-fpm 

# Instala los módulos especificos de laravel
#RUN apt-get install -y php-mbstring php-xml php-bcmath

# Instala las dependencias necesarias para desarrollo (por si se incluye en futuras
# updates o se necesita su uso con node)
RUN apt-get install -y nodejs

# Instalamos repositorio de npm (comentado por seguridad de momento)
#RUN apt-get install npm

# Instalamos repositorio de composer
RUN mkdir /usr/local/bin/composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


EXPOSE 80

