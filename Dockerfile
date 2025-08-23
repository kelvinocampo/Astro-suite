# Imagen base con Apache y PHP 8.2
FROM php:8.2-apache

# Instalar extensiones necesarias para MySQL y otras dependencias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar archivos del proyecto al contenedor
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Habilitar mod_rewrite de Apache (si usas URLs amigables)
RUN a2enmod rewrite

# Exponer puerto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
