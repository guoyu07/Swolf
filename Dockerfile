FROM php:latest

#install swoole extension
RUN pecl install swoole 

#install mbstring extension
RUN docker-php-ext-install mbstring

COPY . /swolf

EXPOSE 9501

WORKDIR /swolf

ENTRYPOINT ["/bin/bash","-c"]
