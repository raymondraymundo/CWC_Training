FROM php:8.3.2-apache
#FROM php:8.1-apache

ADD add_php.ini /usr/local/etc/php/conf.d/

RUN apt-get update -y && apt-get install -y libpng-dev libjpeg-dev zip unzip git libzip-dev libonig-dev
RUN docker-php-ext-configure gd \
		--with-jpeg=/usr/lib/x86_64-linux-gnu/ \
	&& \
    docker-php-ext-install pdo pdo_mysql gd mbstring zip

### composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# apacheの書き込み権限を修正する
RUN usermod -u 1000 www-data \
	&& groupmod -g 1000 www-data

RUN a2enmod rewrite

RUN apt-get install -y dialog locales

RUN localedef -f UTF-8 -i ja_JP ja_JP.UTF-8

# node, npm, gulp
RUN apt-get install -y npm && \
    npm cache clean --force && \
    npm install n -g && \
    n stable && \
    # Remove old "nodejs, npm" installed first to avoid confusing.
    apt-get purge -y nodejs npm && \
    apt-get clean

