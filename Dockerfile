FROM php:8.2-fpm-bookworm

# Copy composer.lock and composer.json
COPY composer.lock composer.json setup.sh /var/www/

# Set working directory
WORKDIR /var/www

RUN chmod +x setup.sh
RUN sudo ./setup.sh

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]