<?php
require __DIR__ . '/fungsi.php'; // memuat session_start(), e(), dan fungsi login

/* =====================================================
   PENGATURAN - UBAH BAGIAN INI SESUAI KEBUTUHAN
   ===================================================== */

// Identitas toko
$NAMA_TOKO       = "Lapak Senja";
$KETERANGAN_TOKO = "Perlengkapan rumah, kopi, dan barang harian buatan pengrajin lokal. Dipilih satu per satu, dikirim ke seluruh Indonesia.";

// Halaman tujuan. Sekarang masih halaman sementara (random).
// Nanti tinggal ganti nilainya dengan file halaman yang sebenarnya.
$HALAMAN = [
    'login'       => 'login.php',
    'ganti_akun'  => 'ganti-akun.php',
    'beranda'     => 'index.php',                  // <-- GANTI jika beranda dipindah
    'produk'      => 'halaman-produk.php',         // <-- GANTI ke halaman produk
    'kontak'      => 'halaman-kontak.php',         // <-- GANTI ke halaman kontak kami
];

// Logout: hapus sesi lalu arahkan ke halaman login
if (isset($_GET['aksi']) && $_GET['aksi'] === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: ' . $HALAMAN['login']);
    exit;
}

// Beranda hanya bisa dibuka setelah login. Jika belum, arahkan ke halaman login.
wajib_login($HALAMAN['login']);

// Nama pengguna. Default "User". Diisi otomatis oleh login.php setelah login berhasil.
$namaPengguna = $_SESSION['nama'] ?? 'User';
$fotoPengguna = $_SESSION['foto'] ?? ''; // kosong = tampil foto profil kosong

// Daftar produk (bebas diubah / diganti dari database).
// Kolom 'foto' : isi dengan alamat gambar, misal "img/kopi.jpg". Jika kosong, dipakai ikon sementara.
$produk = [
    ['id' => 1, 'nama' => 'Kopi Robusta Bangka 250 g',  'harga' => 48000,  'foto' => '', 'ikon' => '☕', 'warna' => '#c9a98a', 'ket' => 'Sangrai medium, aroma pekat dan pahit yang bersih. Cocok untuk kopi tubruk.'],
    ['id' => 2, 'nama' => 'Cangkir Keramik Tangan',      'harga' => 65000,  'foto' => '', 'ikon' => '🍵', 'warna' => '#9fc3bd', 'ket' => 'Dibentuk dan dibakar manual. Kapasitas 300 ml, aman untuk microwave.'],
    ['id' => 3, 'nama' => 'Tas Anyaman Pandan',          'harga' => 125000, 'foto' => '', 'ikon' => '👜', 'warna' => '#d8c27a', 'ket' => 'Anyaman rapat dengan tali kulit sintetis. Ringan dan kuat untuk belanja.'],
    ['id' => 4, 'nama' => 'Lilin Aroma Cendana',         'harga' => 79000,  'foto' => '', 'ikon' => '🕯️', 'warna' => '#e3b7a0', 'ket' => 'Lilin soya, menyala sekitar 35 jam dengan wangi kayu yang lembut.'],
    ['id' => 5, 'nama' => 'Buku Catatan Kulit Daur Ulang','harga' => 55000, 'foto' => '', 'ikon' => '📓', 'warna' => '#a9b4d0', 'ket' => 'Isi 120 halaman kertas krem, sampul dari kulit daur ulang.'],
    ['id' => 6, 'nama' => 'Madu Hutan Murni 500 ml',     'harga' => 98000,  'foto' => '', 'ikon' => '🍯', 'warna' => '#e6c36a', 'ket' => 'Dipanen langsung dari peternak madu hutan, tanpa campuran gula.'],
];

function rupiah($angka) {
    return 'Rp' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($NAMA_TOKO) ?> - Beranda</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --kertas: #f3f6f4;
    --permukaan: #ffffff;
    --tinta: #16302f;
    --tinta-lembut: #5a6e6c;
    --garis: #d5dfdc;
    --utama: #0f4c4a;
    --utama-gelap: #0a3836;
    --sorot: #f0a43a;
    --bahaya: #b3392f;
    --font-judul: "Fraunces", Georgia, serif;
    --font-isi: "Figtree", system-ui, -apple-system, "Segoe UI", sans-serif;
}
* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
    margin: 0;
    background: var(--kertas);
    color: var(--tinta);
    font-family: var(--font-isi);
    line-height: 1.55;
    padding-bottom: 90px;
}
a { color: inherit; text-decoration: none; }
button { font: inherit; cursor: pointer; }
:focus-visible { outline: 3px solid var(--sorot); outline-offset: 2px; }

/* ---------- HEADER ---------- */
.header {
    background: var(--utama);
    color: #fff;
    padding: 28px 24px 34px;
    position: relative;
}
.header-isi { max-width: 1100px; margin: 0 auto; padding-right: 64px; }
.nama-toko {
    font-family: var(--font-judul);
    font-weight: 700;
    font-size: clamp(2rem, 5vw, 3.2rem);
    line-height: 1.1;
    margin: 0;
}
.keterangan-toko {
    max-width: 56ch;
    margin: 10px 0 0;
    color: #cfe3e0;
    font-size: 1.05rem;
}

/* tombol keranjang kanan atas */
.btn-keranjang {
    position: absolute;
    top: 24px; right: 24px;
    width: 52px; height: 52px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,.35);
    background: rgba(255,255,255,.1);
    color: #fff;
    display: grid; place-items: center;
}
.btn-keranjang:hover { background: rgba(255,255,255,.2); }
.btn-keranjang svg { width: 26px; height: 26px; }
.badge {
    position: absolute; top: -6px; right: -6px;
    min-width: 22px; height: 22px; padding: 0 6px;
    border-radius: 11px;
    background: var(--sorot); color: var(--tinta);
    font-size: .8rem; font-weight: 600;
    display: grid; place-items: center;
}
.badge[hidden] { display: none; }

/* ---------- PRODUK ---------- */
main { max-width: 1100px; margin: 0 auto; padding: 36px 24px; }
.judul-bagian { font-family: var(--font-judul); font-size: 1.7rem; margin: 0 0 22px; }
.grid-produk {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 24px;
}
.produk {
    background: var(--permukaan);
    border: 1px solid var(--garis);
    border-radius: 14px;
    overflow: hidden;
    display: flex; flex-direction: column;
}
.foto {
    aspect-ratio: 4 / 3;
    display: grid; place-items: center;
    font-size: 4rem;
}
.foto img { width: 100%; height: 100%; object-fit: cover; display: block; }
.produk-isi { padding: 16px; display: flex; flex-direction: column; flex: 1; }
.produk-nama { font-weight: 600; font-size: 1.05rem; margin: 0; }
.produk-ket { color: var(--tinta-lembut); font-size: .92rem; margin: 6px 0 14px; flex: 1; }
.produk-bawah { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
.harga { font-weight: 600; font-size: 1.1rem; }
.btn-tambah {
    background: var(--utama); color: #fff;
    border: 0; border-radius: 8px;
    padding: 9px 14px; font-weight: 500;
}
.btn-tambah:hover { background: var(--utama-gelap); }

/* ---------- PENGATURAN KIRI BAWAH ---------- */
.btn-pengaturan {
    position: fixed; left: 20px; bottom: 20px; z-index: 30;
    display: flex; align-items: center; gap: 8px;
    background: var(--permukaan); color: var(--tinta);
    border: 1px solid var(--garis); border-radius: 999px;
    padding: 12px 18px; font-weight: 500;
    box-shadow: 0 4px 14px rgba(22,48,47,.15);
}
.btn-pengaturan svg { width: 20px; height: 20px; }
.menu-pengaturan {
    position: fixed; left: 20px; bottom: 80px; z-index: 30;
    width: 280px; max-width: calc(100vw - 40px);
    background: var(--permukaan);
    border: 1px solid var(--garis); border-radius: 14px;
    box-shadow: 0 12px 32px rgba(22,48,47,.2);
    overflow: hidden;
}
.menu-pengaturan[hidden] { display: none; }
.akun { display: flex; align-items: center; gap: 12px; padding: 16px; }
.avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: #dfe7e5; overflow: hidden; flex-shrink: 0;
    display: grid; place-items: end center;
}
.avatar img { width: 100%; height: 100%; object-fit: cover; }
.avatar svg { width: 40px; height: 40px; color: #9db0ad; }
.akun-nama { font-weight: 600; word-break: break-word; }
.menu-pengaturan hr { border: 0; border-top: 1px solid var(--garis); margin: 0; }
.menu-pengaturan a, .menu-pengaturan .item {
    display: block; padding: 12px 16px;
}
.menu-pengaturan a:hover { background: var(--kertas); }
.menu-pengaturan .logout { color: var(--bahaya); font-weight: 500; }

/* ---------- PANEL KERANJANG ---------- */
.lapisan {
    position: fixed; inset: 0; background: rgba(10,30,29,.45); z-index: 40;
}
.lapisan[hidden] { display: none; }
.panel-keranjang {
    position: fixed; top: 0; right: 0; bottom: 0; z-index: 50;
    width: 380px; max-width: 100vw;
    background: var(--permukaan);
    display: flex; flex-direction: column;
    transform: translateX(100%);
    transition: transform .25s ease;
}
.panel-keranjang.buka { transform: translateX(0); }
.panel-atas {
    display: flex; justify-content: space-between; align-items: center;
    padding: 18px 20px; border-bottom: 1px solid var(--garis);
}
.panel-atas h2 { font-family: var(--font-judul); margin: 0; font-size: 1.3rem; }
.btn-tutup { background: none; border: 0; font-size: 1.8rem; line-height: 1; color: var(--tinta-lembut); }
.daftar-keranjang { flex: 1; overflow-y: auto; padding: 8px 20px; }
.kosong { color: var(--tinta-lembut); padding: 24px 0; }
.baris {
    display: grid; grid-template-columns: 1fr auto; gap: 4px 12px;
    padding: 14px 0; border-bottom: 1px solid var(--garis);
}
.baris-nama { font-weight: 500; }
.baris-harga { color: var(--tinta-lembut); font-size: .92rem; }
.jumlah { display: flex; align-items: center; gap: 8px; grid-row: span 2; align-self: center; }
.jumlah button {
    width: 30px; height: 30px; border-radius: 6px;
    border: 1px solid var(--garis); background: var(--permukaan);
}
.panel-bawah { padding: 18px 20px; border-top: 1px solid var(--garis); }
.total { display: flex; justify-content: space-between; font-weight: 600; font-size: 1.15rem; margin-bottom: 14px; }
.btn-bayar {
    width: 100%; padding: 13px; border: 0; border-radius: 10px;
    background: var(--sorot); color: var(--tinta); font-weight: 600;
}
.btn-bayar:disabled { opacity: .5; cursor: not-allowed; }

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    .panel-keranjang { transition: none; }
}
</style>
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="header" id="beranda">
    <div class="header-isi">
        <h1 class="nama-toko"><?= e($NAMA_TOKO) ?></h1>
        <p class="keterangan-toko"><?= e($KETERANGAN_TOKO) ?></p>
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
            <div class="foto" style="background: <?= e($p['warna']) ?>">
                <?php if (!empty($p['foto'])): ?>
                    <img src="<?= e($p['foto']) ?>" alt="<?= e($p['nama']) ?>">
                <?php else: ?>
                    <span aria-hidden="true"><?= $p['ikon'] ?></span>
                <?php endif; ?>
            </div>
            <div class="produk-isi">
                <h3 class="produk-nama"><?= e($p['nama']) ?></h3>
                <p class="produk-ket"><?= e($p['ket']) ?></p>
                <div class="produk-bawah">
                    <span class="harga"><?= rupiah($p['harga']) ?></span>
                    <button class="btn-tambah"
                            data-id="<?= (int)$p['id'] ?>"
                            data-nama="<?= e($p['nama']) ?>"
                            data-harga="<?= (int)$p['harga'] ?>">
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
                <img src="<?= e($fotoPengguna) ?>" alt="Foto profil">
            <?php else: ?>
                <!-- foto profil kosong -->
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <circle cx="12" cy="8" r="4.5"/><path d="M3 22c0-5 4-8 9-8s9 3 9 8z"/>
                </svg>
            <?php endif; ?>
        </div>
        <div class="akun-nama"><?= e($namaPengguna) ?></div>
    </div>
    <hr>
    <!-- 2. Ganti sandi dan nama -->
    <a href="<?= e($HALAMAN['ganti_akun']) ?>">Ganti sandi dan nama</a>
    <hr>
    <!-- 3. Logout: keluar akun lalu menuju halaman login -->
    <a class="logout" href="?aksi=logout">Logout</a>
    <hr>
    <!-- 4. Menu navigasi -->
    <a href="<?= e($HALAMAN['beranda']) ?>">Beranda</a>
    <a href="<?= e($HALAMAN['produk']) ?>">Produk</a>
    <a href="<?= e($HALAMAN['kontak']) ?>">Kontak kami</a>
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

<script>
(function () {
    // ---------- Menu pengaturan ----------
    var btnPengaturan = document.getElementById('btnPengaturan');
    var menu = document.getElementById('menuPengaturan');

    function toggleMenu(buka) {
        menu.hidden = !buka;
        btnPengaturan.setAttribute('aria-expanded', buka ? 'true' : 'false');
    }
    btnPengaturan.addEventListener('click', function (ev) {
        ev.stopPropagation();
        toggleMenu(menu.hidden);
    });
    document.addEventListener('click', function (ev) {
        if (!menu.hidden && !menu.contains(ev.target)) toggleMenu(false);
    });

    // ---------- Keranjang ----------
    var KUNCI = 'keranjang_toko';
    var keranjang = {};
    try { keranjang = JSON.parse(localStorage.getItem(KUNCI)) || {}; } catch (e) { keranjang = {}; }

    var panel = document.getElementById('panelKeranjang');
    var lapisan = document.getElementById('lapisan');
    var daftar = document.getElementById('daftarKeranjang');
    var badge = document.getElementById('badgeKeranjang');
    var totalEl = document.getElementById('totalHarga');
    var btnBayar = document.getElementById('btnBayar');

    function rupiah(n) { return 'Rp' + n.toLocaleString('id-ID'); }
    function simpan() { try { localStorage.setItem(KUNCI, JSON.stringify(keranjang)); } catch (e) {} }

    function bukaPanel(buka) {
        panel.classList.toggle('buka', buka);
        panel.setAttribute('aria-hidden', buka ? 'false' : 'true');
        lapisan.hidden = !buka;
    }

    function gambar() {
        var ids = Object.keys(keranjang), jumlahTotal = 0, harga = 0;
        daftar.innerHTML = '';

        if (!ids.length) {
            daftar.innerHTML = '<p class="kosong">Keranjang masih kosong. Pilih produk lalu tekan "Tambah ke keranjang".</p>';
        }
        ids.forEach(function (id) {
            var it = keranjang[id];
            jumlahTotal += it.qty;
            harga += it.qty * it.harga;

            var baris = document.createElement('div');
            baris.className = 'baris';

            var nama = document.createElement('div');
            nama.className = 'baris-nama';
            nama.textContent = it.nama;

            var info = document.createElement('div');
            info.className = 'baris-harga';
            info.textContent = rupiah(it.harga) + ' x ' + it.qty;

            var ctrl = document.createElement('div');
            ctrl.className = 'jumlah';
            ctrl.innerHTML = '<button aria-label="Kurangi">-</button><span>' + it.qty + '</span><button aria-label="Tambah">+</button>';
            ctrl.children[0].onclick = function () { ubah(id, -1); };
            ctrl.children[2].onclick = function () { ubah(id, 1); };

            baris.appendChild(nama);
            baris.appendChild(ctrl);
            baris.appendChild(info);
            daftar.appendChild(baris);
        });

        badge.textContent = jumlahTotal;
        badge.hidden = jumlahTotal === 0;
        totalEl.textContent = rupiah(harga);
        btnBayar.disabled = jumlahTotal === 0;
    }

    function ubah(id, selisih) {
        if (!keranjang[id]) return;
        keranjang[id].qty += selisih;
        if (keranjang[id].qty <= 0) delete keranjang[id];
        simpan(); gambar();
    }

    document.querySelectorAll('.btn-tambah').forEach(function (tombol) {
        tombol.addEventListener('click', function () {
            var id = tombol.dataset.id;
            if (!keranjang[id]) {
                keranjang[id] = { nama: tombol.dataset.nama, harga: parseInt(tombol.dataset.harga, 10), qty: 0 };
            }
            keranjang[id].qty++;
            simpan(); gambar();
            bukaPanel(true);
        });
    });

    document.getElementById('btnKeranjang').addEventListener('click', function () { bukaPanel(true); });
    document.getElementById('btnTutup').addEventListener('click', function () { bukaPanel(false); });
    lapisan.addEventListener('click', function () { bukaPanel(false); });
    document.addEventListener('keydown', function (ev) {
        if (ev.key === 'Escape') { bukaPanel(false); toggleMenu(false); }
    });

    gambar();
})();
</script>
</body>
</html>
