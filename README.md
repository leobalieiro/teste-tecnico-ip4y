# Inicialização:

No terminal:

* cd web
* php composer install
* docker-compose up -d
* docker-compose exec app bash

No terminal do container app:

* php artisan migrate
* php artisan db:seed
* php artisan db:seed --class=ClientSeeder
* chown -R www-data:www-data /var/www/storage
* chown -R www-data:www-data /var/www/bootstrap/cache
* chmod -R 775 /var/www/storage
* chmod -R 775 /var/www/bootstrap/cache
* ls -ld /var/www/storage
* ls -ld /var/www/bootstrap/cache
