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

5. Для Nested Set вручную создать корневой элемент, от которого будет происходить наследование со следующими параметрами:
```$xslt
id: 0
root_id: 0
parent_id: 0
lft: 0
rgt: 1
lvl: 1
title: <string(255)>
```

Проект доступен по адресу http://0.0.0.0:8888

Админ-панель находится по адресу http://0.0.0.0:8888/admin
