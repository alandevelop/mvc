<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <title>Document</title>
</head>
<body>

<div class="navbar navbar-light bg-light mb-5">

    <a class="nav-link" href="/">Главная</a>
    <a class="nav-link" href="/cart/index">Корзина <span
                class="badge badge-pill badge-primary"><?php echo Cart::getTotalQty(); ?></span></a>

    <?php if ($user = User::isAuth()): ?>
        <a class="nav-link mr-auto mr-2" href="/orders/index">Мои заказы</a>

        <span class="ml-auto mr-2"><?php echo $user['email']; ?></span>
        <a class="nav-link mr-2 btn btn-outline-primary btn-sm" href="/admin/index">Админ панель</a>
        <form action="/user/logout" method="post">
            <button class="btn btn-outline-success" type="submit">Выход</button>
        </form>
    <?php else: ?>
        <a class="nav-link ml-auto btn btn-outline-success mr-2" href="/user/login">Войти</a>
        <a class="nav-link btn btn-outline-success" href="/user/register">Регистрация</a>
    <?php endif; ?>

</div>




