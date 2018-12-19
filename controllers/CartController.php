<?php

class CartController
{
    public function actionIndex()
    {
        if (!Cart::isEmpty()) {
            $ids = array_keys(Cart::getProducts());
            $products = Product::getProductsByIds($ids);
        }

        require_once ROOT . '/views/cart/index.php';
        return true;
    }

    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];

            Cart::addToCart($id, $qty, $price);

            Messages::setMessage('Товар добавлен в корзину.');

            header('Location: /');
            return true;
        }
        return false;
    }

    public function actionRemove($id)
    {
        Cart::removeById($id);
        Messages::setMessage('Товар был удален из корзины.');
        header('Location: /cart/index');
        return true;
    }
}
