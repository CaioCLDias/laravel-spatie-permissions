FROM php:8.1

# Instalação das extensões do PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    libpq-dev

# Instalação das extensões do PHP
RUN docker-php-ext-configure gd  && \
    docker-php-ext-install pdo_pgsql

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria um diretório de trabalho
WORKDIR /app

# Copia o projeto para o diretório de trabalho
COPY . .

# Instalar dependencias do projeto
RUN composer install
