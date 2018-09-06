FROM php:lastest-apache 
RUN docker-php-ext-install mysqli
