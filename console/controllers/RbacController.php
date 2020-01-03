<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Manages RBAC
 * @package console\controllers
 */
final class RbacController extends Controller
{
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