<?php include ROOT . '/views/layouts/header.php' ?>

<?php //dd($orders); ?>

<div class="container">
    <?php foreach ($orders as $order): ?>
        <div class="card mb-5">
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
                <?php foreach ($order as $product): ?>
                    <tr>
                        <td><img src="<?php echo Product::getImageById($product['id']) ?>" width="50px"></td>
                        <td><?php echo $product['title'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['qty'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<?php include ROOT . '/views/layouts/footer.php' ?>
