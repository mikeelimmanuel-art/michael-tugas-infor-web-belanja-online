<?php

namespace App\Controllers;

use App\Libraries\KatalogProduk;

class Home extends BaseController
{
    protected $helpers = ['url', 'form'];

    // Data yang dipakai semua halaman (header toko dan menu pengaturan)
    private function dataDasar(string $judulHalaman): array
    {
        return [
            // Identitas toko (bebas diubah)
            'namaToko'   => 'Lapak Senja',
            'keterangan' => 'Perlengkapan rumah, kopi, dan barang harian buatan pengrajin lokal. Dipilih satu per satu, dikirim ke seluruh Indonesia.',
            'judulHalaman' => $judulHalaman,

            // Data pengguna dari sesi. Default "User" jika nama belum ada.
            'namaPengguna' => session()->get('nama') ?? 'User',
            'fotoPengguna' => session()->get('foto') ?? '', // kosong = foto profil kosong
        ];
    }

    // Beranda: tampilkan 6 produk pertama
    public function index()
    {
        $data           = $this->dataDasar('Beranda');
        $data['produk'] = array_slice(KatalogProduk::semua(), 0, 6);

        return view('beranda', $data);
    }

    // Halaman produk: semua produk, bisa di-scroll, dengan cari dan filter kategori
    public function produk()
    {
        $data             = $this->dataDasar('Produk');
        $data['produk']   = KatalogProduk::semua();
        $data['kategori'] = KatalogProduk::kategori();

        return view('produk', $data);
    }

    // Halaman kontak
    public function kontak()
    {
        $data = $this->dataDasar('Kontak kami');

        // Informasi toko (bebas diganti)
        $data['kontak'] = [
            'alamat'  => 'Jl.parai indah Kp.hakok no.31 sungailiat bangka',
            'telepon' => '083847638683',
            'email'   => 'lapaksenja@gmail.com',
            'jam'     => 'Senin sampai Sabtu, 09.00 sampai 17.00 WIB',
        ];

        return view('kontak', $data);
    }

    // Menerima form kontak. Pesan disimpan ke writable/pesan-kontak.log
    public function kirimKontak()
    {
        $aturan = [
            'nama'  => 'required|max_length[80]',
            'email' => 'required|valid_email|max_length[120]',
            'pesan' => 'required|min_length[10]|max_length[2000]',
        ];

        if (! $this->validate($aturan)) {
            return redirect()->to(site_url('kontak'))->withInput()
                ->with('error', 'Pesan belum terkirim. Pastikan nama, email, dan pesan (minimal 10 karakter) terisi dengan benar.');
        }

        // Hilangkan baris baru di kolom satu baris agar log tidak bisa dipalsukan
        $nama  = preg_replace('/\s+/', ' ', (string) $this->request->getPost('nama'));
        $email = preg_replace('/\s+/', ' ', (string) $this->request->getPost('email'));
        $pesan = (string) $this->request->getPost('pesan');

        $baris = sprintf(
            "[%s] %s <%s>\n%s\n---\n",
            date('Y-m-d H:i:s'),
            $nama,
            $email,
            $pesan
        );

        if (@file_put_contents(WRITEPATH . 'pesan-kontak.log', $baris, FILE_APPEND | LOCK_EX) === false) {
            return redirect()->to(site_url('kontak'))->withInput()
                ->with('error', 'Pesan gagal disimpan. Pastikan folder writable bisa ditulis.');
        }

        return redirect()->to(site_url('kontak'))
            ->with('sukses', 'Terima kasih, pesan Anda sudah kami terima.');
    }
}
