# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie os arquivos do projeto para o diretório de trabalho do contêiner
COPY src/ /var/www/html/

# Copie o arquivo composer.json e composer.lock
COPY composer.json composer.lock /var/www/html/

# Defina o diretório de trabalho
WORKDIR /var/www/html/

# Execute o Composer para instalar as dependências
RUN composer install

# Defina permissões apropriadas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponha a porta 80
EXPOSE 80
