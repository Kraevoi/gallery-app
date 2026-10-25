FROM php:8.2-fpm-alpine

# Устанавливаем системные зависимости (добавлен libzip-dev для расширения zip)
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpq-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql pgsql mbstring xml zip bcmath opcache

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем проект
WORKDIR /var/www
COPY . .

# Устанавливаем зависимости Laravel (без dev, для продакшена)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Права на storage и cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Очищаем кеш конфигов при сборке
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Копируем конфиги nginx и supervisor
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]