<?php

class AdminOrderController extends BaseAdmin
{
    public function actionIndex()
    {
        $orders = Order::getList();

        require_once ROOT . '/views/adminOrder/index.php';
        return true;
    }

    public function actionRemove(int $id)
    {
        if (Order::remove($id)) {
            Messages::setMessage('Заказ удален');
        } else {
            Messages::setMessage('Произошла ошибка при удалении.');
        }
        header('Location: /admin/orders');
        return true;
    }
}