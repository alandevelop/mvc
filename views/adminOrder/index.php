<?php include ROOT . '/views/layouts/header.php' ?>

<div class="container">
    <?php include ROOT . '/views/layouts/messages.php' ?>

    <div class="row">
        <div class="col-sm-3">
            <?php include ROOT . '/views/layouts/admin_sidebar.php' ?>
        </div>

        <div class="col-sm-9">

            <?php foreach ($orders as $key => $order): ?>
                <div class="card mb-5">
                    <div class="card-header d-flex justify-content-between">
                        <span class="">Email: <?php echo $order['email'] ?></span>
                        <a onclick="return confirm('Вы уверены?')" class="btn btn-warning"
                           href="/admin/orders/remove/<?php echo $key ?>">Удалить</a>
                    </div>
                    <table class="table table-sm mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Изображение</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена за шт.</th>
                            <th scope="col">Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($order['products'] as $product): ?>
                            <tr>
                                <td><img src="<?php echo Product::getImageById($product['id']) ?>" width="50px"></td>
                                <td><?php echo $product['title'] ?></td>
                                <td><?php echo $product['price'] ?></td>
                                <td><?php echo $product['qty'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-right card-footer">Общаяя сумма: <b><?php echo Order::getOrderTotal($key) ?> P.</b>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>
