<?php

class AdminProductController extends BaseAdmin
{
    public function actionIndex()
    {
        $products = Product::getList();

        require_once ROOT . '/views/adminProduct/index.php';
        return true;
    }

    public function actionRemove(int $id)
    {
        if (Product::remove($id)) {
            Messages::setMessage('Товар удален');
        } else {
            Messages::setMessage('Произошла ошибка при удалении.');
        }
        header('Location: /admin/products');
        return true;
    }

    public function actionEdit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $options['title'] = strip_tags($_POST['title']);
            $options['description'] = strip_tags($_POST['description']);
            $options['price'] = strip_tags($_POST['price']);
            $options['image'] = null;

            if (file_exists($_FILES['image']['tmp_name'])) {
                $FileUpload = new FileUpload($_FILES['image']);

                if ($newFilename = $FileUpload->upload()) {
                    $options['image'] = $newFilename;

                } else {
                    Messages::setMessage('Произошла ошибка при загрузке файла');
                    header('Location: /admin/products/edit/' . $_POST['id']);
                    return false;
                }
            }
            Product::updateProductById($_POST['id'], $options);
            Messages::setMessage('Информация была успешно обновлена.');
            header('Location: /admin/products/edit/' . $_POST['id']);
            return true;
        }

        $product = Product::getProductById($id);

        require_once ROOT . '/views/adminProduct/edit.php';
        return true;
    }

    public function actionCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $options['title'] = strip_tags($_POST['title']);
            $options['description'] = strip_tags($_POST['description']);
            $options['price'] = strip_tags($_POST['price']);
            $options['image'] = null;

            if (file_exists($_FILES['image']['tmp_name'])) {
                $FileUpload = new FileUpload($_FILES['image']);

                if ($newFilename = $FileUpload->upload()) {
                    $options['image'] = $newFilename;
                } else {
                    Messages::setMessage('Произошла ошибка при загрузке файла');
                    header('Location: /admin/products/edit/' . $_POST['id']);
                    return false;
                }
            }

            Product::create($options);
            Messages::setMessage('Товар был успешно добавлен.');
            header('Location: /admin/products');
            return true;
        }

        require_once ROOT . '/views/adminProduct/create.php';
        return true;
    }

}