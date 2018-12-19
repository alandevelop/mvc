<?php include ROOT . '/views/layouts/header.php' ?>

    <div class="container">

        <?php include ROOT . '/views/layouts/messages.php' ?>

        <div class="row">
            <div class="ml-auto mr-auto col-sm-4">
                <div class="jumbotron">
                    <form action="/user/login" method="post">
                        <input class="form-control mb-2" type="email" name="email" placeholder="email">
                        <input class="form-control mb-2" type="password" name="password" placeholder="password">
                        <button class="btn btn-primary btn-block" type="submit">Войти</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php include ROOT . '/views/layouts/footer.php' ?>