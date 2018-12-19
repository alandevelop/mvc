<?php include ROOT . '/views/layouts/header.php' ?>

<div class="container">
    <?php include ROOT . '/views/layouts/messages.php' ?>

    <div class="row">
        <div class="col-sm-3">
            <?php include ROOT . '/views/layouts/admin_sidebar.php' ?>
        </div>

        <div class="col-sm-9">

            <a href="/admin/products/create" class="btn btn-primary mb-3">Создать товар</a>

            <div class="card mb-5">
                <table class="table table-sm mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Изображение</th>
                        <th scope="col">Название</th>
                        <th scope="col">Цена за шт.</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td><img src="<?php echo Product::getImageById($product['id']) ?>" width="50px"></td>
                            <td><?php echo $product['title'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td>
                                <a onclick="return confirm('Вы уверены?')" class="btn btn-warning"
                                   href="/admin/products/remove/<?php echo $product['id'] ?>">Удалить</a>
                                <a class="btn btn-secondary" href="/admin/products/edit/<?php echo $product['id'] ?>">Редактировать</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>
