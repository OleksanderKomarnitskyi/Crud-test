Crud test 

тестовий проект реалізація стандарного набору CRUD

Використано наступні технології та пакети

Laravel 10

php 8.1

DB sqlite можна перключити на звичайну mysql або іншу реляційну базу даних

inertiajs/vue3 and tailwindcss для фронтової чвстини

Для розвертанні та запуску проекту виконати нвступну послідовність
- git clone 
- composer install
- cp .env.example .env   створити базовий конфіг

для підключення бази даних викорстано драйвер sqlite
але можна встановити і стандартний варіант

- php artisan key:generate
- php artisan migrate --seed

команда php artisan migrate --seed створити таблиці у базі даних 
та наповнить тестовою інформацією 
після цього буде доступно 2 тестових користувача з такими даними 

user@gmail.com  пароль abracadabra
user2@gmail.com  пароль abracadabra

- npm i 
- npm run build

і запускаєм локальний сервер 
- php artisan serve
