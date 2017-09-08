FROM php:latest

COPY . /data

# install swoole extension.
RUN pecl install swoole


# enable swoole
RUN echo 'extension=swoole.so' >> /usr/local/etc/php/php.ini


CMD ["php","/data/app.php"]