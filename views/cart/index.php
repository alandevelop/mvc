<?php include ROOT . '/views/layouts/header.php' ?>


<div class="container">

    <?php include ROOT . '/views/layouts/messages.php' ?>

    <?php if (Cart::isEmpty()): ?>
        <div class="alert alert-secondary" role="alert">
            <div>Ваша корзина пуста.</div>
        </div>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($products as $product): ?>

                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <img src="<?php echo Product::getImageById($product['id']); ?>" width="130px">
                    <h5><?php echo $product['title'] ?></h5>
                    <h5 class="text-primary"><?php echo $product['price'] ?> за шт.</h5>
                    <h5 class="text-primary"><?php echo Cart::countById($product['id']) ?> шт.</h5>
                    <a class="btn btn-warning" onclick="return confirm('Удалить товар?');"
                       href="/cart/remove/<?php echo $product['id'] ?>">Удалить</a>
                </li>

            <?php endforeach; ?>
        </ul>

        <div class="d-flex justify-content-end mt-3 mb-5">
            <h4>Итого: <?php echo Cart::getTotalPrice() ?> Р.</h4>
        </div>

        <div class="row d-flex justify-content-end">
            <div class="col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header"><h5>Оформить заказ</h5></div>
                    <div class="card-body">
                        <form action="/order/add" method="post">
                            <div class="form-group">
                                <input type="email" required class="form-control" name="email" placeholder="E-mail"
                                       value="<?php echo ($user = User::getCurrentUser()) ? $user['email'] : '' ?>"
                                >
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Оформить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>
