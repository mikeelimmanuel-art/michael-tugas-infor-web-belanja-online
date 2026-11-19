<?php

namespace App\Controllers;

use App\Libraries\PenggunaStore;

class Akun extends BaseController
{
    protected $helpers = ['url', 'form'];

    // Halaman ganti sandi dan nama
    public function index()
    {
        $username = session()->get('username');
        $akun     = (new PenggunaStore())->cari($username);

        // Jika akun sudah tidak ada di data, keluarkan dari sesi
        if (! $akun) {
            session()->destroy();

            return redirect()->to(site_url('login'));
        }

        return view('ganti_akun', [
            'username' => $username,
            'nama'     => $akun['nama'],
        ]);
    }

    // Proses ganti nama
    public function simpanNama()
    {
        $nama = trim((string) $this->request->getPost('nama'));

        if ($nama === '') {
            return redirect()->to(site_url('akun'))->with('err_nama', 'Nama tidak boleh kosong.');
        }
        if (mb_strlen($nama) > 50) {
            return redirect()->to(site_url('akun'))->with('err_nama', 'Nama maksimal 50 karakter.');
        }

        if ((new PenggunaStore())->ubahNama(session()->get('username'), $nama)) {
            session()->set('nama', $nama);

            return redirect()->to(site_url('akun'))->with('ok_nama', 'Nama berhasil diubah.');
        }

        return redirect()->to(site_url('akun'))->with('err_nama', 'Nama gagal disimpan. Periksa izin tulis folder writable.');
    }

    // Proses ganti sandi
    public function simpanSandi()
    {
        $lama       = (string) $this->request->getPost('sandi_lama');
        $baru       = (string) $this->request->getPost('sandi_baru');
        $konfirmasi = (string) $this->request->getPost('sandi_konfirmasi');

        $username = session()->get('username');
        $store    = new PenggunaStore();
        $akun     = $store->cari($username);

        if (! $akun || ! password_verify($lama, $akun['sandi'])) {
            return redirect()->to(site_url('akun'))->with('err_sandi', 'Kata sandi lama salah.');
        }
        if (strlen($baru) < 6) {
            return redirect()->to(site_url('akun'))->with('err_sandi', 'Kata sandi baru minimal 6 karakter.');
        }
        if ($baru !== $konfirmasi) {
            return redirect()->to(site_url('akun'))->with('err_sandi', 'Konfirmasi kata sandi tidak sama dengan kata sandi baru.');
        }

        if ($store->ubahSandi($username, $baru)) {
            return redirect()->to(site_url('akun'))->with('ok_sandi', 'Kata sandi berhasil diubah.');
        }

        return redirect()->to(site_url('akun'))->with('err_sandi', 'Kata sandi gagal disimpan. Periksa izin tulis folder writable.');
    }
}
