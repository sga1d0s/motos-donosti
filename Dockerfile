# Stage 1: Builder
FROM composer:2 AS builder

WORKDIR /app

# Copiamos sólo composer.json y composer.lock primero para cachear dependencias
COPY src/composer.json src/composer.lock ./

RUN composer install --no-dev --optimize-autoloader --no-interaction

# Stage 2: Runtime
FROM php:8.2-fpm

# Instala extensiones y herramientas mínimas
RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip git curl && \
    docker-php-ext-install pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Copiamos Composer binario desde el builder
COPY --from=builder /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos el código de la aplicación
COPY src .

# Copiamos las dependencias ya instaladas
COPY --from=builder /app/vendor ./vendor

# Variables de entorno de Composer
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

# Ajustamos permisos de forma más segura
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 755 storage bootstrap/cache

EXPOSE 8000

# Iniciamos como el usuario www-data
USER www-data

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]