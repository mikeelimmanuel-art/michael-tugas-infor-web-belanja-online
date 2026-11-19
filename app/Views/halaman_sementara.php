<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($judul) ?> - Lapak Senja</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/toko.css') ?>">
</head>
<body>
<header class="header">
    <div class="header-isi sempit">
        <a class="kembali" href="<?= site_url('beranda') ?>">&larr; Kembali ke beranda</a>
        <h1 class="judul-halaman"><?= esc($judul) ?></h1>
        <p class="sub">Halaman ini belum dibuat.</p>
    </div>
</header>
<main class="sempit">
    <section class="blok">
        <p>Ini halaman sementara. Ganti isi method di <code>app/Controllers/Home.php</code> dan view-nya dengan halaman yang sesungguhnya.</p>
    </section>
</main>
</body>
</html>
