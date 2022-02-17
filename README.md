Тестовое задание

Развертывание проекта
1) cd project_folder_name
2) cp .env.example .env
3) Прописать коннекты в .env
4) composer install
5) php artisan key:generate
6) npm i
7) npm run watch-poll
8) php artisan db:seed

Начислить на счет
php artisan transaction:add "test@test.ru" --value=3000 comment

Списать со счета
php artisan transaction:add "test@test.ru" --value=-1000 comment
