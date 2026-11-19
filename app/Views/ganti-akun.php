<?php
require __DIR__ . '/fungsi.php';

$NAMA_TOKO = "Lapak Senja";
$HALAMAN_LOGIN   = 'login.php';
$HALAMAN_BERANDA = 'index.php';

wajib_login($HALAMAN_LOGIN);

$username = $_SESSION['username'];
$pengguna = muat_pengguna();

// Jika akun sudah tidak ada di data, keluarkan dari sesi
if (!isset($pengguna[$username])) {
    $_SESSION = [];
    session_destroy();
    header('Location: ' . $HALAMAN_LOGIN);
    exit;
}

$pesanNama = $errorNama = $pesanSandi = $errorSandi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if (!cek_csrf()) {
        $errorNama = $errorSandi = 'Sesi formulir sudah kedaluwarsa. Muat ulang halaman lalu coba lagi.';
    }
    // ----- Ganti nama -----
    elseif ($aksi === 'nama') {
        $namaBaru = trim($_POST['nama'] ?? '');
        if ($namaBaru === '') {
            $errorNama = 'Nama tidak boleh kosong.';
        } elseif (mb_strlen($namaBaru) > 50) {
            $errorNama = 'Nama maksimal 50 karakter.';
        } else {
            $pengguna[$username]['nama'] = $namaBaru;
            if (simpan_pengguna($pengguna)) {
                $_SESSION['nama'] = $namaBaru;
                $pesanNama = 'Nama berhasil diubah.';
            } else {
                $errorNama = 'Nama gagal disimpan. Periksa izin tulis pada folder situs.';
            }
        }
    }
    // ----- Ganti sandi -----
    elseif ($aksi === 'sandi') {
        $lama = $_POST['sandi_lama'] ?? '';
        $baru = $_POST['sandi_baru'] ?? '';
        $konfirmasi = $_POST['sandi_konfirmasi'] ?? '';

        if (!password_verify($lama, $pengguna[$username]['sandi'])) {
            $errorSandi = 'Kata sandi lama salah.';
        } elseif (strlen($baru) < 6) {
            $errorSandi = 'Kata sandi baru minimal 6 karakter.';
        } elseif ($baru !== $konfirmasi) {
            $errorSandi = 'Konfirmasi kata sandi tidak sama dengan kata sandi baru.';
        } else {
            $pengguna[$username]['sandi'] = password_hash($baru, PASSWORD_DEFAULT);
            if (simpan_pengguna($pengguna)) {
                $pesanSandi = 'Kata sandi berhasil diubah.';
            } else {
                $errorSandi = 'Kata sandi gagal disimpan. Periksa izin tulis pada folder situs.';
            }
        }
    }
}

$namaSekarang = $pengguna[$username]['nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ganti sandi dan nama - <?= e($NAMA_TOKO) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --kertas: #f3f6f4; --permukaan: #fff; --tinta: #16302f; --tinta-lembut: #5a6e6c;
    --garis: #d5dfdc; --utama: #0f4c4a; --utama-gelap: #0a3836; --sorot: #f0a43a; --bahaya: #b3392f; --sukses: #1d6b3a;
    --font-judul: "Fraunces", Georgia, serif;
    --font-isi: "Figtree", system-ui, -apple-system, "Segoe UI", sans-serif;
}
* { box-sizing: border-box; }
body { margin: 0; background: var(--kertas); color: var(--tinta); font-family: var(--font-isi); line-height: 1.5; }
a { color: inherit; text-decoration: none; }
:focus-visible { outline: 3px solid var(--sorot); outline-offset: 2px; }
.header { background: var(--utama); color: #fff; padding: 22px 24px 26px; }
.header-isi { max-width: 640px; margin: 0 auto; }
.kembali {
    display: inline-block; margin-bottom: 14px; padding: 8px 14px;
    border: 1px solid rgba(255,255,255,.4); border-radius: 8px; font-weight: 500;
}
.kembali:hover { background: rgba(255,255,255,.14); }
.header h1 { font-family: var(--font-judul); margin: 0; font-size: clamp(1.6rem, 4vw, 2.2rem); line-height: 1.15; }
.header p { margin: 6px 0 0; color: #cfe3e0; }
main { max-width: 640px; margin: 0 auto; padding: 28px 24px 48px; display: grid; gap: 24px; }
section { background: var(--permukaan); border: 1px solid var(--garis); border-radius: 14px; padding: 24px; }
section h2 { font-family: var(--font-judul); font-size: 1.3rem; margin: 0 0 16px; }
label { display: block; font-weight: 500; margin-bottom: 6px; }
input {
    width: 100%; padding: 11px 12px; font: inherit; color: inherit;
    border: 1px solid var(--garis); border-radius: 8px; background: #fff; margin-bottom: 16px;
}
input:focus { border-color: var(--utama); }
button {
    padding: 11px 20px; border: 0; border-radius: 10px; font: inherit; font-weight: 600;
    background: var(--utama); color: #fff; cursor: pointer;
}
button:hover { background: var(--utama-gelap); }
.pesan { border-radius: 8px; padding: 10px 12px; margin-bottom: 16px; font-size: .95rem; }
.pesan.error { background: #fbeceb; color: var(--bahaya); border: 1px solid #efc4c0; }
.pesan.sukses { background: #e8f5ec; color: var(--sukses); border: 1px solid #bfe0c9; }
.catatan { color: var(--tinta-lembut); font-size: .9rem; margin: -8px 0 16px; }
</style>
</head>
<body>
<header class="header">
    <div class="header-isi">
        <a class="kembali" href="<?= e($HALAMAN_BERANDA) ?>">&larr; Kembali ke beranda</a>
        <h1>Ganti sandi dan nama</h1>
        <p>Masuk sebagai <?= e($username) ?></p>
    </div>
</header>

<main>
    <!-- ============ GANTI NAMA ============ -->
    <section>
        <h2>Ganti nama</h2>
        <form method="post" action="ganti-akun.php">
            <?php if ($errorNama): ?><div class="pesan error" role="alert"><?= e($errorNama) ?></div><?php endif; ?>
            <?php if ($pesanNama): ?><div class="pesan sukses" role="status"><?= e($pesanNama) ?></div><?php endif; ?>

            <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>">
            <input type="hidden" name="aksi" value="nama">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= e($namaSekarang) ?>" maxlength="50" required>

            <button type="submit">Simpan nama</button>
        </form>
    </section>

    <!-- ============ GANTI SANDI ============ -->
    <section>
        <h2>Ganti kata sandi</h2>
        <form method="post" action="ganti-akun.php">
            <?php if ($errorSandi): ?><div class="pesan error" role="alert"><?= e($errorSandi) ?></div><?php endif; ?>
            <?php if ($pesanSandi): ?><div class="pesan sukses" role="status"><?= e($pesanSandi) ?></div><?php endif; ?>

            <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>">
            <input type="hidden" name="aksi" value="sandi">

            <label for="sandi_lama">Kata sandi lama</label>
            <input type="password" id="sandi_lama" name="sandi_lama" autocomplete="current-password" required>

            <label for="sandi_baru">Kata sandi baru</label>
            <input type="password" id="sandi_baru" name="sandi_baru" autocomplete="new-password" minlength="6" required>
            <p class="catatan">Minimal 6 karakter.</p>

            <label for="sandi_konfirmasi">Ulangi kata sandi baru</label>
            <input type="password" id="sandi_konfirmasi" name="sandi_konfirmasi" autocomplete="new-password" minlength="6" required>

            <button type="submit">Simpan kata sandi</button>
        </form>
    </section>
</main>
</body>
</html>
