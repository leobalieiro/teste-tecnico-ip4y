# Use uma imagem base PHP com Composer
FROM php:8.1-fpm

# Instalar dependências do sistema
RUN apt-get update -qq && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    netcat-openbsd \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto para o contêiner
COPY . .

# Instalar dependências do Composer
RUN composer install --prefer-dist --no-interaction --optimize-autoloader

# Configurar permissões para o diretório de armazenamento e cache
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expor a porta necessária
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
