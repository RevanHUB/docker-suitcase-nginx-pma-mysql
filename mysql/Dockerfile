FROM 'mysql:latest'
LABEL description="Servicio de MySQL"

COPY ./sql/api_integracion.sql /docker-entrypoint-initdb.d/init.sql
RUN chmod 777 /docker-entrypoint-initdb.d/*.sql

#RUN chmod 777 /docker-entrypoint-initdb.d/*.sh
#RUN chmod -R 777 /docker-entrypoint-initdb.d/
# Asigna la base de datos inicial
#COPY ./sql/db.sql /docker-entrypoint-initdb.d
EXPOSE 3306 
