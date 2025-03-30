# Usar la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copiar los archivos fuente al contenedor
COPY . /var/www/html/

# Copiar la configuración de Apache
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Instalar las extensiones necesarias
RUN docker-php-ext-install mysqli

# Exponer el puerto 80
EXPOSE 80