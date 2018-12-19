<?php

class Order
{
    public static function add($email)
    {
        $user = User::getCurrentUser() ?? null;
        $time = time();
        $products = Cart::getProducts();

        $db = Db::getInstance();

        $db->exec("INSERT INTO orders(email) VALUES ('" . $user['email'] . "')");
        $order_id = $db->lastInsertId();

        $order_product_tab_val = '';
        foreach ($products as $id => $val) {
            $order_product_tab_val .= "(" . $order_id . ", " . $id . ", " . $val['qty'] . ", " . $time . "),";
        }
        $order_product_tab_val = trim($order_product_tab_val, ',');

        $sql = "INSERT into order_product(order_id, product_id, qty, created_at) VALUES $order_product_tab_val";
        $result = $db->exec($sql);

        return $result;
    }

    public static function getUserOrders(string $email)
    {
        $db = Db::getInstance();
        $sql = "SELECT p.title, p.price, p.id, op.qty, op.order_id, op.created_at
                FROM products p, order_product op
                WHERE p.id = op.product_id AND op.order_id IN 
                (SELECT id FROM orders WHERE email='$email')
                ORDER BY op.created_at ASC";

        $statement = $db->query($sql);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $new_array = [];
        foreach ($result as $row) {
            $new_array[$row['order_id']][] = $row;
        }

        return $new_array;
    }

    public static function getList()
    {
        $db = Db::getInstance();
        $sql = "SELECT o.id as order_id, o.email, op.created_at, p.id,p.title, p.price, p.image, op.qty 
                FROM products p, order_product op, orders o
                WHERE p.id = op.product_id AND op.order_id = o.id
                ORDER BY op.created_at ASC";

        $statement = $db->query($sql);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $new_array = [];
        foreach ($result as $row) {
            $order_id = $row['order_id'];

            $new_array[$order_id]['email'] = $row['email'];
            $new_array[$order_id]['created_at'] = $row['created_at'];

            unset(
                $row['email'],
                $row['created_at'],
                $row['order_id']
            );

            $new_array[$order_id]['products'][] = $row;
        }

        return $new_array;
    }

    public static function getOrderTotal(int $id): int
    {
        $db = Db::getInstance();
        $sql = "SELECT p.id, p.price, op.qty
                FROM order_product op, products p
                WHERE op.order_id = $id AND op.product_id = p.id";

        $statement = $db->query($sql);
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);


        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['qty'];
        }

        return $total;
    }

    public static function remove(int $id)
    {
        $db = Db::getInstance();
        $sql = "DELETE FROM orders WHERE id = $id";

        if ($db->exec($sql)) {
            return true;
        }

        return false;
    }
}