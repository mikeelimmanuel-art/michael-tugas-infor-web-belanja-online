<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk - Lapak Senja</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/toko.css') ?>">
</head>
<body class="halaman-login">
<main class="kartu">
    <div class="kartu-atas">
        <h1>Lapak Senja</h1>
        <p>Masuk untuk mulai belanja.</p>
    </div>

    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="pesan error" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= esc(old('username')) ?>" autocomplete="username" required autofocus>

        <label for="sandi">Kata sandi</label>
        <input type="password" id="sandi" name="sandi" autocomplete="current-password" required>

        <button type="submit" class="btn-utama">Masuk</button>
    </form>
</main>
</body>
</html>
