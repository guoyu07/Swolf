FROM php:latest

#install swoole extension
RUN pecl install swoole

#install mbstring extension
RUN pecl install mbstring

COPY . /swolf

EXPOSE 9501

WORKDIR /swolf

ENTRYPOINT ["./srvctl","start","host=127.0.0.1","port=9501"]


