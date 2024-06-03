<p>Selamat Datang <span class="font-bold">
        <?= $_SESSION['user_name'] ?>
    </span>
</p>

<p>Role : <span class="font-bold"><?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                                        echo 'Anda adalah admin.';
                                    } else {
                                        echo 'Anda bukan admin.';
                                    } ?></span></p>
<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) : ?>
    <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-primary">Masuk ke Dashboard</a>
<?php endif; ?>