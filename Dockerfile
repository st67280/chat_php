#FROM ubuntu:latest
#LABEL authors="nurmurmur"
#
#ENTRYPOINT ["top", "-b"]

FROM php:7.4-apache

COPY . /var/www/html

EXPOSE 80