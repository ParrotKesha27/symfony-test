# symfony-test

## Установка

1. Поднять Docker-контейнеры

`docker-compose up -d`

2. Зайти в контейнер php-fpm

`docker-compose exec php-fpm bash`

3. Перейти в папку с проектом Symfony и запустить установку

```
cd symfony
composer install
```

4. Выполнить установку npm-модулей и Encore
```
npm install
./node_modules/.bin/encore dev
```

5. Создать схему базы данных

`bin/console doctrine:schema:create`

6. Загрузить фикстуры

`bin/console doctrine:fixtures:load`

Проект доступен по адресу http://0.0.0.0:8888

Админ-панель находится по адресу http://0.0.0.0:8888/admin
