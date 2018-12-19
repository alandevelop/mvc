<?php

class Cart
{
    public static function addToCart(int $productId, int $quantity, $price)
    {
        $_SESSION['cart'][$productId] = ['qty' => $quantity, 'price' => $price];
    }

    public static function hasProduct(int $id)
    {
        return isset($_SESSION['cart'][$id]);
    }

    public static function getTotalQty()
    {
        $total = 0;
        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $id => $product) {
                $total += $product['qty'];
            }
        }
        return $total;
    }

    public static function getProducts()
    {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        }
        return false;
    }

    public static function isEmpty()
    {
        return empty($_SESSION['cart']);
    }

    public static function countById($id)
    {
        return $_SESSION['cart'][$id]['qty'];
    }

    public static function removeById($id)
    {
        unset($_SESSION['cart'][$id]);
    }

    public static function getTotalPrice()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['price'] * $product['qty'];
        }

        return $total;
    }
}