FROM php:latest

#install swoole extension
RUN pecl install swoole \
  && echo "extension=swoole.so" >> /usr/local/etc/php/conf.d/swoole.ini \
  && docker-php-ext-install mbstring \
  && apt-get update \
  && apt-get install -y git \
  && apt-get clean \
  && apt-get autoclean \
  && git clone https://github.com/chenqinghe/Swolf.git \
  && cd Swolf \
  && git checkout v0.4 \
  && curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && chmod u+x /usr/local/bin/composer \
  && composer install

EXPOSE 9501

WORKDIR /Swolf

ENTRYPOINT ["/bin/bash","-c"]
