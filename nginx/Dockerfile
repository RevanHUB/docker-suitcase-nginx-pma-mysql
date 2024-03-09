FROM nginx:latest
LABEL description="Servicio de Servidor Web NginX en Contenedor"

# Instala las dependencias necesarias
RUN apt-get  -y update && apt-get -y upgrade
RUN apt-get install -y nano

# Instala las dependencias necesarias para desarrollo (por si se incluye en futuras
# updates o se necesita su uso con node)
RUN apt-get install -y nodejs

# Instalamos repositorio de npm (comentado por seguridad de momento)
#RUN apt-get install npm

# Instalamos repositorio de composer
RUN mkdir /usr/local/bin/composer
#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN chown -R www-data:www-data /usr/share/nginx/html
#RUN chmod 755 /usr/share/nginx/
#RUN chmod 755 /usr/share/nginx/html
#RUN chmod 755 /usr/share/nginx/html/index.php

EXPOSE 80

