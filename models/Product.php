<?php

class Product
{
    static $no_image = '/uploads/no-image.png';

    public static function getList(): array
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM products';

        $statment = $db->query($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductsByIds(array $ids_arr): array
    {
        $ids_str = implode(',', $ids_arr);

        $db = Db::getInstance();
        $sql = "SELECT * FROM products WHERE id IN ($ids_str)";

        $statement = $db->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductById(int $id): array
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM products WHERE id = $id";

        $statement = $db->query($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function getImageById(int $id): string
    {
        $db = Db::getInstance();
        $sql = "SELECT image FROM products WHERE id = :id";

        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result['image'] == null) {
            return '/uploads/' . $result['image'];
        } else {
            return self::$no_image;
        }
    }

    public static function remove(int $id)
    {
        if (self::getImageById($id) != self::$no_image) {
            $prev = ROOT . '/web' . self::getImageById($id);
            if (file_exists($prev)) {
                unlink($prev);
            }
        }

        $db = Db::getInstance();
        $sql = "DELETE FROM products WHERE id = $id";

        if ($db->exec($sql)) {
            return true;
        }

        return false;
    }

    public static function updateProductById($id, $options)
    {
        $db = Db::getInstance();
        $sql = 'UPDATE products SET title=:title, description=:description, price=:price WHERE id = :id';

        $result = $db->prepare($sql);

        $result->bindParam(':title', $options['title']);
        $result->bindParam(':description', $options['description']);
        $result->bindParam(':price', $options['price']);
        $result->bindParam(':id', $id);

        $result->execute();

        if ($options['image'] != null) {
            self::attachNewImage($id, $options['image']);
        }
    }

    public static function create($options)
    {
        $db = Db::getInstance();
        $sql = "INSERT INTO products(title, description, price) VALUES (:title, :description, :price)";

        $result = $db->prepare($sql);

        $result->bindParam(':title', $options['title']);
        $result->bindParam(':description', $options['description']);
        $result->bindParam(':price', $options['price']);

        $result->execute();

        if ($options['image'] != null) {
            self::attachNewImage($db->lastInsertId(), $options['image']);
        }
    }

    public static function attachNewImage($id, $image)
    {
        if (self::getImageById($id) != self::$no_image) {
            $prev = ROOT . '/web' . self::getImageById($id);
            if (file_exists($prev)) {
                unlink($prev);
            }
        }

        $db = Db::getInstance();
        $sql = "UPDATE products SET image = :image WHERE id = :id";

        $result = $db->prepare($sql);

        $result->bindParam(':image', $image);
        $result->bindParam(':id', $id);

        return $result->execute();
    }

}