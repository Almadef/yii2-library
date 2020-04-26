<?php

namespace backend\actions;

use yii\base\Action;

/**
 * Class DeleteAction
 * @package backend\actions
 */
final class DeleteAction extends Action
{
    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws \Throwable
     */
    public function run($id)
    {
        $this->controller->findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}