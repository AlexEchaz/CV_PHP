FROM php:8.0-apache

#Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

#Copier les fichiers du projet dans le container
COPY . /var/www/html

#Activer le module Apache mod_rewrite pour les routes propres
RUN a2enmod rewrite

#Exposer le port 80
EXPOSE 80
