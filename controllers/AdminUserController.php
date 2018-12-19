<?php

class AdminUserController extends BaseAdmin
{
    public static function actionIndex()
    {
        $users = User::getList();

        require_once ROOT . '/views/adminUser/index.php';
        return true;
    }

    public static function actionRemove($id)
    {
        User::remove($id);

        header('Location: /admin/users');
        return true;
    }
}