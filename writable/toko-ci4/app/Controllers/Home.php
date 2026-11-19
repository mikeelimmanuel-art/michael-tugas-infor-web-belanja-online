<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $helpers = ['url'];

    // Beranda toko
    public function index()
    {
        $data = [
            // Identitas toko (bebas diubah)
            'namaToko'   => 'Lapak Senja',
            'keterangan' => 'Perlengkapan rumah, kopi, dan barang harian buatan pengrajin lokal. Dipilih satu per satu, dikirim ke seluruh Indonesia.',

            // Data pengguna dari sesi. Default "User" jika nama belum ada.
            'namaPengguna' => session()->get('nama') ?? 'User',
            'fotoPengguna' => session()->get('foto') ?? '', // kosong = foto profil kosong

            // Daftar produk (bebas diubah / nanti diganti dari database).
            // 'foto': isi alamat gambar di folder public, misal 'img/kopi.jpg'. Kosong = pakai ikon.
            'produk' => [
                ['id' => 1, 'nama' => 'Kopi Robusta Bangka 250 g',       'harga' => 48000,  'foto' => '', 'ikon' => '☕',  'warna' => '#c9a98a', 'ket' => 'Sangrai medium, aroma pekat dan pahit yang bersih. Cocok untuk kopi tubruk.'],
                ['id' => 2, 'nama' => 'Cangkir Keramik Tangan',         'harga' => 65000,  'foto' => '', 'ikon' => '🍵',  'warna' => '#9fc3bd', 'ket' => 'Dibentuk dan dibakar manual. Kapasitas 300 ml, aman untuk microwave.'],
                ['id' => 3, 'nama' => 'Tas Anyaman Pandan',             'harga' => 125000, 'foto' => '', 'ikon' => '👜',  'warna' => '#d8c27a', 'ket' => 'Anyaman rapat dengan tali kulit sintetis. Ringan dan kuat untuk belanja.'],
                ['id' => 4, 'nama' => 'Lilin Aroma Cendana',            'harga' => 79000,  'foto' => '', 'ikon' => '🕯️', 'warna' => '#e3b7a0', 'ket' => 'Lilin soya, menyala sekitar 35 jam dengan wangi kayu yang lembut.'],
                ['id' => 5, 'nama' => 'Buku Catatan Kulit Daur Ulang',  'harga' => 55000,  'foto' => '', 'ikon' => '📓',  'warna' => '#a9b4d0', 'ket' => 'Isi 120 halaman kertas krem, sampul dari kulit daur ulang.'],
                ['id' => 6, 'nama' => 'Madu Hutan Murni 500 ml',        'harga' => 98000,  'foto' => '', 'ikon' => '🍯',  'warna' => '#e6c36a', 'ket' => 'Dipanen langsung dari peternak madu hutan, tanpa campuran gula.'],
            ],
        ];

        return view('beranda', $data);
    }

    // Halaman sementara. Ganti isinya dengan halaman produk yang sesungguhnya.
    public function produk()
    {
        return view('halaman_sementara', ['judul' => 'Produk']);
    }

    // Halaman sementara. Ganti isinya dengan halaman kontak yang sesungguhnya.
    public function kontak()
    {
        return view('halaman_sementara', ['judul' => 'Kontak kami']);
    }
}
