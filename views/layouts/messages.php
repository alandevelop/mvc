<?php if (Messages::hasMessages()): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php foreach (Messages::getMessages() as $message): ?>
            <div><?php echo $message; ?></div>
        <?php endforeach; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>