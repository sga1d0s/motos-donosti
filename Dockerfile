# Dockerfile

# Utiliza PHP 8.2 (compatible con tu proyecto Laravel)
FROM php:8.2-fpm

# Instala dependencias de Laravel
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        git \
        curl && \
    docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia el proyecto completo (garantiza que artisan está disponible)
COPY src /var/www/html

# Permitir Composer como superusuario
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instala dependencias de Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Da permisos a las carpetas necesarias
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 8000
EXPOSE 8000

# Comando por defecto para ejecutar el servidor de Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
