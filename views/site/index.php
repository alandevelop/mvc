<?php include ROOT . '/views/layouts/header.php' ?>

<div class="container">
    <?php include ROOT . '/views/layouts/messages.php' ?>

    <div class="row">
        <div class="col-md-12 jumbotron">
            Данный пример не претендует на роль полноценного фреймворка для использования в реальных проектах.
            Основная задача состояла в том, чтобы построить MVC каркас на PHP без использования сторонних библиотек и
            Composer.

            Для демонстрации работы реализован некоторый базовый функционал:
            <ul>
                <li>Регистрация, авторизация пользователей.</li>
                <li>Создание, редактирование, удаление товаров.</li>
                <li>Корзина с возможностью удаления и указанием количества товаров.</li>
                <li>Просмотр истории своих заказов для авторизованных пользователей.</li>
                <li>Доступ в админ панель только для админ пользователей.</li>
            </ul>

            Доступы для админ пользователя:
            <ul>
                <li>email: admin@admin.com</li>
                <li>пароль: admin</li>
            </ul>

        </div>
    </div>

    <div class="row row-eq-height">
        <?php foreach ($products as $product): ?>
            <div class="col-sm-4 mb-4">
                <div class="card" style="height: 100%;">
                    <img class="card-img-top" src="<?php echo Product::getImageById($product['id']) ?>"
                         alt="Card image cap">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $product['title'] ?></h5>
                        <p class="card-text"><?php echo $product['description'] ?></p>
                        <h5 class="card-title"><?php echo $product['price'] ?> P.</h5>

                        <?php if (!Cart::hasProduct($product['id'])): ?>

                            <form class="mt-auto qty-form form-inline" action="/cart/add" method="post">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary minus" type="button">-</button>
                                    </div>
                                    <input type="number" name="qty" class="form-control qty" value="1"
                                           aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price'] ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary add" type="button">+</button>
                                        <button class="btn btn-outline-secondary" type="submit">В корзину</button>
                                    </div>
                                </div>
                            </form>

                        <?php else: ?>
                            <button class="btn btn-outline-secondary" disabled>Добавлен в корзину</button>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>

