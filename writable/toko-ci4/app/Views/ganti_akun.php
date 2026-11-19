<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ganti sandi dan nama - Lapak Senja</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/toko.css') ?>">
</head>
<body>
<header class="header">
    <div class="header-isi sempit">
        <a class="kembali" href="<?= site_url('beranda') ?>">&larr; Kembali ke beranda</a>
        <h1 class="judul-halaman">Ganti sandi dan nama</h1>
        <p class="sub">Masuk sebagai <?= esc($username) ?></p>
    </div>
</header>

<main class="sempit">
    <!-- ============ GANTI NAMA ============ -->
    <section class="blok">
        <h2>Ganti nama</h2>
        <form method="post" action="<?= site_url('akun/nama') ?>">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('err_nama')): ?>
                <div class="pesan error" role="alert"><?= esc(session()->getFlashdata('err_nama')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('ok_nama')): ?>
                <div class="pesan sukses" role="status"><?= esc(session()->getFlashdata('ok_nama')) ?></div>
            <?php endif; ?>

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= esc($nama, 'attr') ?>" maxlength="50" required>

            <button type="submit" class="btn-utama">Simpan nama</button>
        </form>
    </section>

    <!-- ============ GANTI SANDI ============ -->
    <section class="blok">
        <h2>Ganti kata sandi</h2>
        <form method="post" action="<?= site_url('akun/sandi') ?>">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('err_sandi')): ?>
                <div class="pesan error" role="alert"><?= esc(session()->getFlashdata('err_sandi')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('ok_sandi')): ?>
                <div class="pesan sukses" role="status"><?= esc(session()->getFlashdata('ok_sandi')) ?></div>
            <?php endif; ?>

            <label for="sandi_lama">Kata sandi lama</label>
            <input type="password" id="sandi_lama" name="sandi_lama" autocomplete="current-password" required>

            <label for="sandi_baru">Kata sandi baru</label>
            <input type="password" id="sandi_baru" name="sandi_baru" autocomplete="new-password" minlength="6" required>
            <p class="catatan">Minimal 6 karakter.</p>

            <label for="sandi_konfirmasi">Ulangi kata sandi baru</label>
            <input type="password" id="sandi_konfirmasi" name="sandi_konfirmasi" autocomplete="new-password" minlength="6" required>

            <button type="submit" class="btn-utama">Simpan kata sandi</button>
        </form>
    </section>
</main>
</body>
</html>
