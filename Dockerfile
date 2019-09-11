FROM debian:stretch

RUN apt-get update
RUN apt-get -y install gnupg curl wget

# For installing php7
RUN apt -y install lsb-release apt-transport-https ca-certificates
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php5.6.list

RUN apt-get update

RUN apt-get -y install rake php5.6 php5.6-cli php5.6-curl php-pear phpunit php5.6-xml php5.6-mbstring

WORKDIR /braintree-php


