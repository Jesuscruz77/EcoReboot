# Usar la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copiar los archivos fuente del proyecto al contenedor
COPY . /var/www/html/

# Copiar la configuración personalizada de Apache
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Instalar la extensión mysqli para la conexión a la base de datos
RUN docker-php-ext-install mysqli

# Exponer el puerto 80
EXPOSE 80
