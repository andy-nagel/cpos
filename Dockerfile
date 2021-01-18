FROM php:7.4-fpm

# Copy composer.lock and composer.json
COPY webroot/composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl mysqli && docker-php-ext-enable mysqli
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

RUN apt update -y
# sendmail config
############################################

RUN apt-get install msmtp msmtp-mta -y

# root is the person who gets all mail for userids < 1000
#RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "# /etc/msmtprc" >> /etc/msmtprc
RUN echo "" >> /etc/msmtprc
RUN echo "defaults" >> /etc/msmtprc
RUN echo "auth    on" >> /etc/msmtprc
RUN echo "tls            on" >> /etc/msmtprc
RUN echo "tls_trust_file /etc/ssl/certs/ca-certificates.crt" >> /etc/msmtprc
RUN echo "logfile        ~/.msmtp.log" >> /etc/msmtprc
RUN echo "account        gmail" >> /etc/msmtprc
RUN echo "host           smtp.gmail.com" >> /etc/msmtprc
RUN echo "port           587" >> /etc/msmtprc
RUN echo "from           andynagel2000@gmail.com" >> /etc/msmtprc
RUN echo "user           andynagel2000" >> /etc/msmtprc
RUN echo "password Dyw2k@s3" >> /etc/msmtprc
RUN echo "account default : gmail" >> /etc/msmtprc
RUN echo "UseTLS=YES" >> /etc/msmtprc
RUN echo "UseSTARTTLS=YES" >> /etc/msmtprc


# Set up php sendmail config
#RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Copy existing application directory permissions
#COPY --chgrp=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
