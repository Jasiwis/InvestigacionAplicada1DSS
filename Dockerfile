# Usamos una imagen de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones de PHP necesarias (como PDO para MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Copiar el código fuente de la API al contenedor
COPY . /var/www/html/

# Habilitar el módulo de reescritura en Apache
RUN a2enmod rewrite

# Dar permisos adecuados a la carpeta de la API
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para que la API esté accesible
EXPOSE 80
