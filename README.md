### Стэк проекта
* nginx 1.17
* php-fpm 7.4
* mysql 5.7
* sphinx 3.1.1-612d99f

### План разворачивания dev-окружения через docker-compose
1. В docker/config/nginx создать default.conf;
2. В docker/config/sphinx создать sphinx.conf;
3. В корне кодовой базы выполнить команду `docker-compose up -d --build`;
4. Перейти в контейнер php `docker exec -ti yii2-library_php-fpm_1 bash`;
5. Выполнить комманды:
    1. `composer install`;
    2. `php yii init`;
    3. `php yii migrate-rbac`;
    4. `php yii migrate`;
6. Если нужно создать дефолтного администратора и библиотекаря, то выполнить комманду `php yii rbac/create-default-user`;
7. После заполнения проекта выполнить команду `docker-compose run --rm sphinx indexer --config "/opt/sphinx/conf/sphinx.conf" --all --rotate`.

### Тестирование
Для тестирования используется БД mysql-test, перед началом тестов нужно выполнить комманды:
1. `php yii_test migrate-rbac`;
2. `php yii_test migrate`, после появления новых миграций ее нужно снова выполнять, для поддержки в актуальном состоянии и этой базы.

Запускаются все тесты командой `vendor/bin/codecept run`.

Запустить тесты определенного блока программы `vendor/bin/codecept run -c [frontend, backend, common]`.