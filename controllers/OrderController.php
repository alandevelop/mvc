<?php

class OrderController
{
    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !Cart::isEmpty()) {
            $email = $_POST['email'];

            Order::add($email);
            unset($_SESSION['cart']);
            Messages::setMessage('Ваш заказ оформлен.');
            header('Location: /');
            return true;
        }
        return false;
    }

    public function actionIndex()
    {
        if (!User::isAuth()) {
            header('Location: /user/login');
            return true;
        }

        $user = User::getCurrentUser();
        $orders = Order::getUserOrders($user['email']);

        require_once ROOT . '/views/order/index.php';
        return true;
    }
}