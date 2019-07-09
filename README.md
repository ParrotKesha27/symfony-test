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

4. Создать схему базы данных

`bin/console doctrine:schema:create`

5. Загрузить фикстуры

`bin/console doctrine:fixtures:load`

Проект доступен по адресу http://0.0.0.0:8888

Админ-панель находится по адресу http://0.0.0.0:8888/admin
