FROM php:latest

#install swoole extension
RUN pecl install swoole \
  && echo "extension=swoole.so" >> /usr/local/etc/php/conf.d/swoole.ini \
  && docker-php-ext-install mbstring \
  && sudo apt-get install git \
  && git clone https://github.com/chenqinghe/swolf.git

EXPOSE 9501

WORKDIR /swolf

ENTRYPOINT ["/bin/bash","-c"]
