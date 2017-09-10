FROM php:latest

COPY . /swolf

# install swoole extension.
RUN pecl install swoole


# enable swoole
RUN echo 'extension=swoole.so' >> /usr/local/etc/php/php.ini


CMD ["php","/swolf/app.php","--host","0.0.0.0","--port","9501"]