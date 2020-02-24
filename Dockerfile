FROM php:7.4-cli

WORKDIR /usr/src/app

COPY . /usr/src/app

# Update Depedency
RUN apt-get update && \
    apt-get install -yq git zip unzip &&\
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

CMD [ "php","-S","0.0.0.0:8000","index.php" ]