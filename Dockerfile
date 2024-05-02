# Use a base image suitable for ARM architecture
FROM arm32v7/php:apache

# Install PostgreSQL client and PHP extension
RUN apt-get update && \
    apt-get install -y postgresql-client && \
    docker-php-ext-install pdo pdo_pgsql

# Copy your PHP files and any other necessary files into the Docker image
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

