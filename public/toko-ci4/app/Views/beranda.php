<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($namaToko) ?> - Beranda</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/toko.css') ?>">
</head>
<body class="ada-pengaturan">

<!-- ================= HEADER ================= -->
<header class="header" id="beranda">
    <div class="header-isi">
        <h1 class="nama-toko"><?= esc($namaToko) ?></h1>
        <p class="keterangan-toko"><?= esc($keterangan) ?></p>
    </div>

    <!-- Keranjang kanan atas -->
    <button class="btn-keranjang" id="btnKeranjang" aria-label="Buka keranjang belanja">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/>
            <path d="M2 3h3l2.4 12.2a2 2 0 0 0 2 1.6h8.2a2 2 0 0 0 2-1.5L21.5 8H6"/>
        </svg>
        <span class="badge" id="badgeKeranjang" hidden>0</span>
    </button>
</header>

<!-- ================= PRODUK ================= -->
<main>
    <h2 class="judul-bagian">Produk pilihan</h2>
    <div class="grid-produk">
        <?php foreach ($produk as $p): ?>
        <article class="produk">
            <div class="foto" style="background: <?= esc($p['warna'], 'attr') ?>">
                <?php if (! empty($p['foto'])): ?>
                    <img src="<?= base_url($p['foto']) ?>" alt="<?= esc($p['nama'], 'attr') ?>">
                <?php else: ?>
                    <span aria-hidden="true"><?= $p['ikon'] ?></span>
                <?php endif; ?>
            </div>
            <div class="produk-isi">
                <h3 class="produk-nama"><?= esc($p['nama']) ?></h3>
                <p class="produk-ket"><?= esc($p['ket']) ?></p>
                <div class="produk-bawah">
                    <span class="harga">Rp<?= number_format($p['harga'], 0, ',', '.') ?></span>
                    <button class="btn-tambah"
                            data-id="<?= (int) $p['id'] ?>"
                            data-nama="<?= esc($p['nama'], 'attr') ?>"
                            data-harga="<?= (int) $p['harga'] ?>">
                        Tambah ke keranjang
                    </button>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</main>

<!-- ================= PENGATURAN KIRI BAWAH ================= -->
<button class="btn-pengaturan" id="btnPengaturan" aria-expanded="false" aria-controls="menuPengaturan">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3h0a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5h0a1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9v0a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/>
    </svg>
    Pengaturan
</button>

<nav class="menu-pengaturan" id="menuPengaturan" hidden aria-label="Menu pengaturan">
    <!-- 1. Tampilan akun -->
    <div class="akun">
        <div class="avatar">
            <?php if ($fotoPengguna): ?>
                <img src="<?= esc($fotoPengguna, 'attr') ?>" alt="Foto profil">
            <?php else: ?>
                <!-- foto profil kosong -->
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <circle cx="12" cy="8" r="4.5"/><path d="M3 22c0-5 4-8 9-8s9 3 9 8z"/>
                </svg>
            <?php endif; ?>
        </div>
        <div class="akun-nama"><?= esc($namaPengguna) ?></div>
    </div>
    <hr>
    <!-- 2. Ganti sandi dan nama -->
    <a href="<?= site_url('akun') ?>">Ganti sandi dan nama</a>
    <hr>
    <!-- 3. Logout -> kembali ke halaman login -->
    <a class="logout" href="<?= site_url('logout') ?>">Logout</a>
    <hr>
    <!-- 4. Menu navigasi -->
    <a href="<?= site_url('beranda') ?>">Beranda</a>
    <a href="<?= site_url('produk') ?>">Produk</a>
    <a href="<?= site_url('kontak') ?>">Kontak kami</a>
</nav>

<!-- ================= PANEL KERANJANG ================= -->
<div class="lapisan" id="lapisan" hidden></div>
<aside class="panel-keranjang" id="panelKeranjang" aria-label="Keranjang belanja" aria-hidden="true">
    <div class="panel-atas">
        <h2>Keranjang</h2>
        <button class="btn-tutup" id="btnTutup" aria-label="Tutup keranjang">&times;</button>
    </div>
    <div class="daftar-keranjang" id="daftarKeranjang"></div>
    <div class="panel-bawah">
        <div class="total"><span>Total</span><span id="totalHarga">Rp0</span></div>
        <button class="btn-bayar" id="btnBayar" disabled>Lanjut ke pembayaran</button>
    </div>
</aside>

<script src="<?= base_url('js/toko.js') ?>"></script>
</body>
</html>
