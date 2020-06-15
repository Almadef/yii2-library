# Eng
### Project Stack
* nginx 1.17
* php-fpm 7.4
* mysql 5.7
* sphinx 3.1
* memcached 1.6

### Plan for deploying a dev environment through docker-compose
1. In docker/config/nginx create default.conf;
2. In docker/config/sphinx create sphinx.conf;
3. At the root of the code base, run the command `docker-compose up -d nginx php-fpm mysql sphinx phpmyadmin`;
4. Go to php container `docker-compose exec php-fpm sh`;
5. Run the commands:
    1. `composer install`;
    2. `php yii init`;
    3. `php yii migrate-rbac`;
    4. `php yii migrate`;
6. If you need to create a default administrator and librarian, then run the command `php yii rbac/create-default-user`;
7. Exit the containe `exit`;
8. After filling the content, run the command `docker-compose run --rm sphinx indexer --config "/opt/sphinx/conf/sphinx.conf" --all --rotate && docker-compose up -d sphinx`.

### Testing
For testing, the mysql-test database is used, before starting the tests, you need to run the commands:
1. At the root of the code base, execute the command `docker-compose up -d mysql-test sphinx-test`;
2. Go to php container `docker-compose exec php-fpm sh`;
3. Run the commands:
    1. `php yii_test migrate-rbac`;
    2. `php yii_test migrate`, after the appearance of new migrations it must be performed again, to maintain the current state of this database.
    
All tests are run with the command in the php container `vendor/bin/codecept run`.

Run tests on a specific program block `vendor/bin/codecept run -c [frontend, backend, common]`.

____

# Рус
### Стэк проекта
* nginx 1.17
* php-fpm 7.4
* mysql 5.7
* sphinx 3.1
* memcached 1.6

### План разворачивания dev-окружения через docker-compose
1. В docker/config/nginx создать default.conf;
2. В docker/config/sphinx создать sphinx.conf;
3. В корне кодовой базы выполнить команду `docker-compose up -d nginx php-fpm mysql sphinx phpmyadmin`;
4. Перейти в контейнер php `docker-compose exec php-fpm sh`;
5. Выполнить комманды:
    1. `composer install`;
    2. `php yii init`;
    3. `php yii migrate-rbac`;
    4. `php yii migrate`;
6. Если нужно создать дефолтного администратора и библиотекаря, то выполнить комманду `php yii rbac/create-default-user`;
7. Выйти из контейнера `exit`;
8. После заполнения контента выполнить команду `docker-compose run --rm sphinx indexer --config "/opt/sphinx/conf/sphinx.conf" --all --rotate && docker-compose up -d sphinx`.

### Тестирование
Для тестирования используется БД mysql-test, перед началом тестов нужно выполнить комманды:
1. В корне кодовой базы выполнить команду `docker-compose up -d mysql-test sphinx-test`;
2. Перейти в контейнер php `docker-compose exec php-fpm sh`;
3. Выполнить комманды:
    1. `php yii_test migrate-rbac`;
    2. `php yii_test migrate`, после появления новых миграций ее нужно снова выполнять, для поддержки в актуальном состоянии и этой базы.

Запускаются все тесты командой в php контейнере `vendor/bin/codecept run`.

Запустить тесты определенного блока программы `vendor/bin/codecept run -c [frontend, backend, common]`.
