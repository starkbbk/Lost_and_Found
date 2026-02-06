FROM php:8.2-apache

# Install base extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Fix Apache MPM conflict (Ensure only prefork is enabled)
RUN a2dismod mpm_event && a2dismod mpm_worker && a2enmod mpm_prefork rewrite

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Expose port (Render/Railway typically use env PORT, Apache listens on 80 by default)
EXPOSE 80
