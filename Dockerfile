FROM php:latest

#install swoole extension
RUN pecl install swoole \
  && echo "extension=swoole.so" >> /usr/local/etc/php/conf.d/swoole.ini \
  && docker-php-ext-install mbstring \
  && apt-get install git \
  && git clone https://github.com/chenqinghe/Swolf.git \
  && cd Swolf \
  && git checkout v0.4 \

EXPOSE 9501

WORKDIR /swolf

ENTRYPOINT ["/bin/bash","-c"]
