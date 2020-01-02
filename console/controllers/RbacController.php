<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class RbacController
 * @package console\controllers
 */
final class RbacController extends Controller
{
    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //Блок прав раздела книги
        $viewBook = $auth->createPermission('viewBook');
        $viewBook->description = 'View a book';
        $auth->add($viewBook);

        $createBook = $auth->createPermission('createBook');
        $createBook->description = 'Create a book';
        $auth->add($createBook);

        $updateBook = $auth->createPermission('updateBook');
        $updateBook->description = 'Update a book';
        $auth->add($updateBook);

        $deleteBook = $auth->createPermission('deleteBook');
        $deleteBook->description = 'Delete a book';
        $auth->add($deleteBook);

        //Блок прав раздела авторы
        $viewAuthor = $auth->createPermission('viewAuthor');
        $viewAuthor->description = 'View an author';
        $auth->add($viewAuthor);

        $createAuthor = $auth->createPermission('createAuthor');
        $createAuthor->description = 'Create an author';
        $auth->add($createAuthor);

        $updateAuthor = $auth->createPermission('updateAuthor');
        $updateAuthor->description = 'Update an author';
        $auth->add($updateAuthor);

        $deleteAuthor = $auth->createPermission('deleteAuthor');
        $deleteAuthor->description = 'Delete an author';
        $auth->add($deleteAuthor);

        //Блок прав раздела пользователи
        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'View a user';
        $auth->add($viewUser);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update a user';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete a user';
        $auth->add($deleteUser);


        // добавляем роль библиотекаря и даём разрешения
        $librarian = $auth->createRole('librarian');
        $auth->add($librarian);
        // на книги
        $auth->addChild($librarian, $viewBook);
        $auth->addChild($librarian, $createBook);
        $auth->addChild($librarian, $updateBook);
        $auth->addChild($librarian, $deleteBook);
        // на авторов
        $auth->addChild($librarian, $viewAuthor);
        $auth->addChild($librarian, $createAuthor);
        $auth->addChild($librarian, $updateAuthor);
        $auth->addChild($librarian, $deleteAuthor);

        // добавляем роль админа и даём разрешения
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        // на права библиотекрая
        $auth->addChild($admin, $librarian);
        // на пользователей
        $auth->addChild($admin, $viewUser);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);
    }

    /**
     * Create default admin and librarian
     * @throws \Exception
     */
    public function actionCreateDefaultUser()
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->auth_key = 'NREygnv3gvAtQ3Hxz-bckxv3mq5MFIir';
        $admin->password_hash = '$2y$13$X.TmIjSfu844ETg4LypEauhuFc6vgE1Jxz1/GohSW1hH88CLq5u2e'; //adminadmin
        $admin->email = 'admin@adm.com';
        $admin->status = 10;
        $admin->created_at = 1577969955;
        $admin->updated_at = 1577969955;
        $admin->verification_token = 'QmONtq_TsTH039rskWP3fhRImTNHIP_R_1577969955';

        $librarian = new User();
        $librarian->username = 'librarian';
        $librarian->auth_key = 'VOQHe-2CFQLV3rqINledSGCtiQqvCIak';
        $librarian->password_hash = '$2y$13$eWT3C7FipegOSquQRhtKh./q5X3GDKcmAsLBfYOOTqONMwIo04sTO'; //librarian
        $librarian->email = 'librarian@adm.com';
        $librarian->status = 10;
        $librarian->created_at = 1577969959;
        $librarian->updated_at = 1577969959;
        $librarian->verification_token = 'uTcIvToZzNuDn6H0U-DhX7hCoud_6ROh_1577970078';

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $admin->save();
            $librarian->save();
            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole('admin'), $admin->getId());
            $auth->assign($auth->getRole('librarian'), $librarian->getId());
            $transaction->commit();
            $this->stdout($this->ansiFormat('Success!' . PHP_EOL, Console::FG_GREEN)
                . 'Admin login: admin' . PHP_EOL
                . 'Admin password: adminadmin' . PHP_EOL
                . 'Librarian login: librarian' . PHP_EOL
                . 'Librarian password: librarian' . PHP_EOL);
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
        }
    }
}