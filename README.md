# Backend

cd backend

copy .env.example to .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourDB
DB_USERNAME=yourUser
DB_PASSWORD=yourUserPassword

composer i

php artisan key:generate

php artisan migrate

php artisan serve


# Frontend

cd frontend

npm i

npm run start

# Test
Возможно понадовиться установить mbstring extention

sudo nano /etc/php/8.1/cli/php.ini

sudo apt-get install php8.1-mbstring

;extention=mbstring


php artisan test


