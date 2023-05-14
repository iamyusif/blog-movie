<?php if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?php echo $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message'] ?>
    </div>

    <?php unset($_SESSION['message']);
    unset($_SESSION['message_type']); endif; ?>