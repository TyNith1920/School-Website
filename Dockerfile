FROM php:8.2-apache

# ដំឡើង Tools, libicu-dev (intl), libzip-dev (zip) និង PostgreSQL Driver
RUN apt-get update && apt-get install -y libpq-dev libicu-dev libzip-dev zip unzip git nodejs npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql intl zip

# កំណត់ទីតាំងឱ្យ Apache ចង្អុលទៅកាន់ Folder "public" របស់ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# បើកដំណើរការ Apache Rewrite (សម្រាប់ URL របស់ Laravel)
RUN a2enmod rewrite

# Copy កូដទាំងអស់ចូលទៅកាន់ Server
COPY . /var/www/html

# ដំឡើង Composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# ដំឡើង NPM និង Build Tailwind CSS (Filament)
RUN npm install && npm run build

# ផ្តល់សិទ្ធិឱ្យ Laravel អាច Save រូបភាព ឬ Cache បាន
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache