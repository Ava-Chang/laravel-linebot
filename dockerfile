FROM richarvey/nginx-php-fpm:1.9.1

COPY . .

# Install linebot php extension
RUN docker-php-ext-install sockets \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL daily

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]