FROM php:8.2-cli

# Install PostgreSQL extension
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

WORKDIR /app

COPY . .

CMD ["php", "index.php"]