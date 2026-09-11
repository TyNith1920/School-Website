FROM php:8.2-apache

# 1. ដំឡើង Tools, សម្រាប់អាន Database និង Extension ផ្សេងៗដែលចំបាច់
RUN apt-get update && apt-get install -y libpq-dev libicu-dev libzip-dev zip unzip git nodejs npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql intl zip

# 2. កំណត់ទីតាំង Document Root ឱ្យចង្អុលទៅ public របស់ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. បើក Mod Rewrite
RUN a2enmod rewrite

# 4. Copy Code ចូល Server
COPY . /var/www/html

# 5. ដំឡើង Composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. ដំឡើង NPM និង Build សម្រាប់ Filament/Tailwind
RUN npm install && npm run build

# 7. ផ្តល់សិទ្ធិ Folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Start Apache ដោយកំណត់ Port តាម Render (ចំណុចសំខាន់ដើម្បីកុំឱ្យ Error Timeout)
CMD sed -i "s/80/$PORT/g" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf && apache2-foreground