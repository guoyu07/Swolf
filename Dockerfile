FROM php:7.1.12

#install swoole extension
RUN pecl install swoole \
  && echo "extension=swoole.so" >> /usr/local/etc/php/conf.d/swoole.ini \
  && docker-php-ext-install mbstring

#install git and pull source code
RUN apt-get update \
  && apt-get install -y git \
  && apt-get clean \
  && apt-get autoclean \
  && git clone https://github.com/chenqinghe/Swolf.git \
  && cd Swolf \
  && git checkout v0.4

# install dependencies
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && chmod u+x /usr/local/bin/composer \
  && composer install

EXPOSE 9501

WORKDIR /Swolf

CMD ["php","start.php"]
