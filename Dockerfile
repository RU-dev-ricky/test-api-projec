FROM php:7.4-fpm-alpine

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx
ENV PORT 9000

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --ignore-platform-reqs 
RUN chown -R www-data: /app
# CMD bash -c "chmod -R 777 /var/www && php artisan migrate --seed && php artisan storage:link"
CMD sh /app/docker/startup.sh

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
