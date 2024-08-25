# Usa una imagen base con PHP y Apache
FROM php:8.2-apache

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configura PHP: zona horaria y sesiones
RUN echo "date.timezone = America/Argentina/Buenos_Aires" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "session.cookie_lifetime=120" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "session.gc_maxlifetime=120" >> /usr/local/etc/php/conf.d/custom.ini

# Establece permisos para los directorios
RUN chown -R www-data:www-data /var/www

# Configura Apache para permitir scripts PHP
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

# Define el punto de entrada
ENTRYPOINT ["apache2-foreground"]
