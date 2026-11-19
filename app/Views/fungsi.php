<?php
/* =====================================================
   FUNGSI BERSAMA (dipakai login.php, ganti-akun.php, index.php)
   Data pengguna disimpan di file pengguna-data.php.
   Jika nanti memakai database, cukup ganti isi fungsi
   muat_pengguna() dan simpan_pengguna() di bawah ini.
   ===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const FILE_PENGGUNA = __DIR__ . '/pengguna-data.php';

// Akun awal. SEGERA ganti sandinya lewat halaman "Ganti sandi dan nama".
const USERNAME_AWAL = 'admin';
const SANDI_AWAL    = 'admin123';

function muat_pengguna(): array {
    if (!file_exists(FILE_PENGGUNA)) {
        simpan_pengguna([
            USERNAME_AWAL => [
                'nama' => 'Admin',
                'sandi' => password_hash(SANDI_AWAL, PASSWORD_DEFAULT),
            ],
        ]);
    }
    $data = include FILE_PENGGUNA;
    return is_array($data) ? $data : [];
}

function simpan_pengguna(array $data): bool {
    // Disimpan sebagai file PHP agar isinya tidak terbaca jika diakses lewat browser
    $isi = "<?php\nreturn " . var_export($data, true) . ";\n";
    $ok = file_put_contents(FILE_PENGGUNA, $isi, LOCK_EX) !== false;
    if (function_exists('opcache_invalidate')) {
        opcache_invalidate(FILE_PENGGUNA, true);
    }
    return $ok;
}

function sudah_login(): bool {
    return !empty($_SESSION['username']);
}

function wajib_login(string $halamanLogin): void {
    if (!sudah_login()) {
        header('Location: ' . $halamanLogin);
        exit;
    }
}

function e($teks): string {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

// Perlindungan CSRF untuk form
function token_csrf(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function cek_csrf(): bool {
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
