# Utiliser l'image officielle PHP 8.3
FROM php:8.2

# Mettre à jour le système et installer les dépendances nécessaires
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \
    libzip-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring

# Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /app

# Copier le contenu de l'application dans le conteneur
COPY . /app

# Changer les permissions pour le répertoire de l'application
RUN chown -R www-data:www-data /app

# Installer les dépendances PHP avec Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --verbose

# Installer le package JWT Auth
RUN composer require php-open-source-saver/jwt-auth

# Exécuter les commandes artisan pour initialiser l'application
CMD php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider" && \
    php artisan storage:link && \
    php artisan key:generate && \
    php artisan migrate:fresh && \
    php artisan db:seed && \
    php artisan jwt:secret && \
    php artisan serve --host=0.0.0.0 --port=8181

# Exposer le port 8181 pour accéder à l'application
EXPOSE 8181
