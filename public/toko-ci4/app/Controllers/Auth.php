<?php

namespace App\Controllers;

use App\Libraries\PenggunaStore;

class Auth extends BaseController
{
    protected $helpers = ['url', 'form'];

    // Tampilkan halaman login
    public function login()
    {
        // Jika sudah login, langsung ke beranda
        if (session()->get('username')) {
            return redirect()->to(site_url('beranda'));
        }

        return view('login');
    }

    // Proses form login
    public function prosesLogin()
    {
        $username = trim((string) $this->request->getPost('username'));
        $sandi    = (string) $this->request->getPost('sandi');

        if ($username === '' || $sandi === '') {
            return redirect()->to(site_url('login'))->withInput()->with('error', 'Isi username dan kata sandi.');
        }

        $akun = (new PenggunaStore())->cari($username);

        if ($akun && password_verify($sandi, $akun['sandi'])) {
            session()->regenerate();
            session()->set([
                'username' => $username,
                'nama'     => $akun['nama'],
            ]);

            // Setelah login berhasil -> beranda
            return redirect()->to(site_url('beranda'));
        }

        return redirect()->to(site_url('login'))->withInput()->with('error', 'Username atau kata sandi salah.');
    }

    // Logout: hapus sesi lalu kembali ke halaman login
    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}
