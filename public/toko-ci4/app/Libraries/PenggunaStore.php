<?php

namespace App\Libraries;

/**
 * Penyimpanan data pengguna sederhana (tanpa database).
 * Data disimpan di writable/pengguna.php (folder writable tidak bisa diakses dari browser).
 *
 * Nanti jika memakai database, cukup ganti isi method di class ini
 * (atau ganti dengan Model CodeIgniter). Controller tidak perlu diubah banyak.
 */
class PenggunaStore
{
    // Akun awal. SEGERA ganti sandinya lewat halaman "Ganti sandi dan nama".
    private const USERNAME_AWAL = 'admin';
    private const SANDI_AWAL    = 'admin123';

    private string $file;

    public function __construct()
    {
        $this->file = WRITEPATH . 'pengguna.php';
    }

    public function semua(): array
    {
        if (! is_file($this->file)) {
            $this->simpan([
                self::USERNAME_AWAL => [
                    'nama'  => 'Admin',
                    'sandi' => password_hash(self::SANDI_AWAL, PASSWORD_DEFAULT),
                ],
            ]);
        }

        $data = include $this->file;

        return is_array($data) ? $data : [];
    }

    public function cari(string $username): ?array
    {
        return $this->semua()[$username] ?? null;
    }

    public function ubahNama(string $username, string $namaBaru): bool
    {
        $data = $this->semua();
        if (! isset($data[$username])) {
            return false;
        }
        $data[$username]['nama'] = $namaBaru;

        return $this->simpan($data);
    }

    public function ubahSandi(string $username, string $sandiBaru): bool
    {
        $data = $this->semua();
        if (! isset($data[$username])) {
            return false;
        }
        $data[$username]['sandi'] = password_hash($sandiBaru, PASSWORD_DEFAULT);

        return $this->simpan($data);
    }

    private function simpan(array $data): bool
    {
        $isi = "<?php\nreturn " . var_export($data, true) . ";\n";
        $ok  = file_put_contents($this->file, $isi, LOCK_EX) !== false;

        if (function_exists('opcache_invalidate')) {
            opcache_invalidate($this->file, true);
        }

        return $ok;
    }
}
