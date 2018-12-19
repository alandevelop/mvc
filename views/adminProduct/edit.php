<?php include ROOT . '/views/layouts/header.php' ?>

<div class="container">
    <?php include ROOT . '/views/layouts/messages.php' ?>

    <div class="row">
        <div class="col-sm-3">
            <?php include ROOT . '/views/layouts/admin_sidebar.php' ?>
        </div>

        <div class="col-sm-9">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="/admin/products/edit" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Заголовок</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="Заголовок"
                                       value="<?php echo $product['title'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Описание</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" placeholder="Описание"
                                          rows="3"><?php echo $product['description'] ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Цена</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="price" placeholder="Цена"
                                       value="<?php echo $product['price'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Изображение</label>
                            <div class="col-sm-9">
                                <img id="productImg" src="<?php echo Product::getImageById($product['id']) ?>"
                                     width="130px">
                                <input type="file" name="image" id="uploadImage">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>
