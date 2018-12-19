<?php include ROOT . '/views/layouts/header.php' ?>

<div class="container">
    <?php include ROOT . '/views/layouts/messages.php' ?>

    <div class="row">
        <div class="col-sm-3">
            <?php include ROOT . '/views/layouts/admin_sidebar.php' ?>
        </div>

        <div class="col-sm-9">

            <div class="card mb-5">
                <table class="table table-sm mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Тип</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['type'] ?></td>
                            <td>
                                <?php if ($user['type'] == "admin"): ?>
                                    <button class="btn btn-warning" disabled>Удалить</button>
                                <?php else: ?>
                                    <a onclick="return confirm('Вы уверены?')" class="btn btn-warning"
                                       href="/admin/users/remove/<?php echo $user['id'] ?>">Удалить</a>
                                <?php endif; ?>
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
