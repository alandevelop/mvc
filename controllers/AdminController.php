<?php

class AdminController extends BaseAdmin
{
    public function actionIndex()
    {
        require_once ROOT . '/views/admin/index.php';
        return true;
    }
}