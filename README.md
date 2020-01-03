### План разворачивания проекта:
1. В docker/config/nginx создать default.conf;
2. В корне кодовой базы выполнить команду `docker-compose up -d --build`;
3. Перейти в контейнер php `docker exec -ti yii2-library_php-fpm_1 bash`;
4. Выполнить комманды:
    1. `composer install`;
    2. `php yii init`;
    3. `php yii migrate-rbac`;
    4. `php yii migrate`;
5. Если нужно создать дефолтного администратора и библиотекаря, то выполнить комманду `php yii rbac/create-default-user`.
