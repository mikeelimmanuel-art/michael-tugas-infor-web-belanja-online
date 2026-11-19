<?php

namespace App\Libraries;

/**
 * Daftar produk bersama. Dipakai beranda dan halaman produk.
 * Nanti kalau pindah ke database, cukup ganti isi method semua().
 *
 * 'foto' : alamat gambar di folder public, misal 'img/kopi.jpg'. Kosong = pakai ikon.
 */
class KatalogProduk
{
    public static function semua(): array
    {
        return [
            ['id' => 1,  'kategori' => 'Makanan & Minuman', 'nama' => 'Kopi Robusta Bangka 250 g',      'harga' => 48000,  'foto' => '', 'ikon' => '☕',  'warna' => '#c9a98a', 'ket' => 'Sangrai medium, aroma pekat dan pahit yang bersih. Cocok untuk kopi tubruk.'],
            ['id' => 2,  'kategori' => 'Rumah',             'nama' => 'Cangkir Keramik Tangan',        'harga' => 65000,  'foto' => '', 'ikon' => '🍵',  'warna' => '#9fc3bd', 'ket' => 'Dibentuk dan dibakar manual. Kapasitas 300 ml, aman untuk microwave.'],
            ['id' => 3,  'kategori' => 'Fashion',           'nama' => 'Tas Anyaman Pandan',            'harga' => 125000, 'foto' => '', 'ikon' => '👜',  'warna' => '#d8c27a', 'ket' => 'Anyaman rapat dengan tali kulit sintetis. Ringan dan kuat untuk belanja.'],
            ['id' => 4,  'kategori' => 'Rumah',             'nama' => 'Lilin Aroma Cendana',           'harga' => 79000,  'foto' => '', 'ikon' => '🕯️', 'warna' => '#e3b7a0', 'ket' => 'Lilin soya, menyala sekitar 35 jam dengan wangi kayu yang lembut.'],
            ['id' => 5,  'kategori' => 'Alat Tulis',        'nama' => 'Buku Catatan Kulit Daur Ulang', 'harga' => 55000,  'foto' => '', 'ikon' => '📓',  'warna' => '#a9b4d0', 'ket' => 'Isi 120 halaman kertas krem, sampul dari kulit daur ulang.'],
            ['id' => 6,  'kategori' => 'Makanan & Minuman', 'nama' => 'Madu Hutan Murni 500 ml',       'harga' => 98000,  'foto' => '', 'ikon' => '🍯',  'warna' => '#e6c36a', 'ket' => 'Dipanen langsung dari peternak madu hutan, tanpa campuran gula.'],
            ['id' => 7,  'kategori' => 'Makanan & Minuman', 'nama' => 'Teh Melati Kemasan 100 g',      'harga' => 36000,  'foto' => '', 'ikon' => '🫖',  'warna' => '#b9d6a8', 'ket' => 'Daun teh hijau dengan bunga melati asli. Seduh 3 menit, wangi dan segar.'],
            ['id' => 8,  'kategori' => 'Rumah',             'nama' => 'Piring Kayu Jati Bulat',        'harga' => 72000,  'foto' => '', 'ikon' => '🍽️', 'warna' => '#d9b48f', 'ket' => 'Kayu jati daur ulang, diameter 24 cm, dilapisi minyak makan yang aman.'],
            ['id' => 9,  'kategori' => 'Fashion',           'nama' => 'Topi Bambu Lebar',              'harga' => 89000,  'foto' => '', 'ikon' => '👒',  'warna' => '#e8d3a2', 'ket' => 'Anyaman bambu halus dengan pinggiran lebar, melindungi dari terik matahari.'],
            ['id' => 10, 'kategori' => 'Alat Tulis',        'nama' => 'Pensil Kayu Set Isi 12',        'harga' => 28000,  'foto' => '', 'ikon' => '✏️', 'warna' => '#f0cf8a', 'ket' => 'Kayu sengon bersertifikat, grafit HB halus dan tidak mudah patah.'],
            ['id' => 11, 'kategori' => 'Makanan & Minuman', 'nama' => 'Gula Aren Cetak 500 g',         'harga' => 32000,  'foto' => '', 'ikon' => '🟤',  'warna' => '#bf9670', 'ket' => 'Dimasak tradisional dari nira aren pilihan. Manis legit, cocok untuk kopi.'],
            ['id' => 12, 'kategori' => 'Rumah',             'nama' => 'Vas Tanah Liat Mini',           'harga' => 45000,  'foto' => '', 'ikon' => '🏺',  'warna' => '#e0a98c', 'ket' => 'Tinggi 14 cm, cocok untuk bunga kering atau tanaman kecil di meja.'],
            ['id' => 13, 'kategori' => 'Fashion',           'nama' => 'Syal Tenun Katun',              'harga' => 110000, 'foto' => '', 'ikon' => '🧣',  'warna' => '#c7a8c9', 'ket' => 'Ditenun tangan dengan motif sederhana. Lembut dan hangat tanpa membuat gerah.'],
            ['id' => 14, 'kategori' => 'Alat Tulis',        'nama' => 'Kartu Pos Ilustrasi Set Isi 8', 'harga' => 40000,  'foto' => '', 'ikon' => '💌',  'warna' => '#f2b9b0', 'ket' => 'Delapan desain ilustrasi pemandangan nusantara di atas kertas tebal.'],
            ['id' => 15, 'kategori' => 'Makanan & Minuman', 'nama' => 'Sambal Roa Botol 180 g',        'harga' => 52000,  'foto' => '', 'ikon' => '🌶️', 'warna' => '#e69a8d', 'ket' => 'Ikan roa asap, cabai rawit, dan bawang. Pedas gurih, tahan 3 bulan.'],
            ['id' => 16, 'kategori' => 'Rumah',             'nama' => 'Keranjang Rotan Serbaguna',     'harga' => 135000, 'foto' => '', 'ikon' => '🧺',  'warna' => '#d6b77d', 'ket' => 'Untuk pakaian, mainan, atau selimut. Anyaman kuat dengan dua pegangan.'],
            ['id' => 17, 'kategori' => 'Fashion',           'nama' => 'Kaos Katun Organik',            'harga' => 95000,  'foto' => '', 'ikon' => '👕',  'warna' => '#a8c4d9', 'ket' => 'Katun organik 24s, potongan longgar, disablon manual dengan tinta air.'],
            ['id' => 18, 'kategori' => 'Alat Tulis',        'nama' => 'Pulpen Logam Isi Ulang',        'harga' => 62000,  'foto' => '', 'ikon' => '🖋️', 'warna' => '#b3bfc9', 'ket' => 'Badan kuningan yang awet. Tinta hitam halus, isi ulang mudah dicari.'],
        ];
    }

    /** Daftar kategori unik, urutan sesuai kemunculan. */
    public static function kategori(): array
    {
        return array_values(array_unique(array_column(self::semua(), 'kategori')));
    }
}
