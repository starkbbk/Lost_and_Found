FROM php:8.2-apache-bullseye

# System dependencies (for stability)
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Force Apache MPM Prefork (Nuclear option)
# 1. Remove all MPM load/conf files from enabled directory
# 2. explicit a2dismod just in case
# 3. Enable prefork and rewrite
RUN find /etc/apache2/mods-enabled -name "mpm_*.load" -delete \
    && find /etc/apache2/mods-enabled -name "mpm_*.conf" -delete \
    && a2dismod mpm_event || true \
    && a2dismod mpm_worker || true \
    && a2enmod mpm_prefork rewrite

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

EXPOSE 80
