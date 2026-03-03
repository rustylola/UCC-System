# ─────────────────────────────────────────────────────────────
# Base: PHP 7.4 with Apache (matches local Apache/2.4.48 PHP/7.4.22)
# ─────────────────────────────────────────────────────────────
FROM php:7.4-apache

# Install only the extensions used locally: mysqli, curl, mbstring
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libssl-dev \
    libonig-dev \
    git \
    unzip \
  && docker-php-ext-install \
       mysqli \
       curl \
       mbstring \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (needed for .htaccess)
RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Update Apache config to use our document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy application source code
COPY ./src /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
  && find /var/www/html -type d -exec chmod 755 {} \; \
  && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80