# === Stage 1: Composer dependencies ===
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json ./
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-redis

# === Stage 2: Final PHP runtime with Redis ===
FROM php:8.2-cli AS app

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=vendor /app/vendor/ ./vendor
COPY . .

CMD ["php", "index.php"]