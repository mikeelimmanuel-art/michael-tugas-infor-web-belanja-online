<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TokoKita | Belanja Online Mudah & Terpercaya</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- ===== HEADER ===== -->
  <header class="header">
    <div class="container nav">
      <a href="index.html" class="logo">🛍️ TokoKita</a>
      <nav class="menu">
        <a href="index.html">Beranda</a>
        <a href="#produk">Produk</a>
        <a href="#tentang">Tentang Toko</a>
        <a href="#kontak">Kontak</a>
      </nav>
      <button class="btn-keranjang" id="btnKeranjang">🛒 Keranjang <span class="badge" id="badge">0</span></button>
    </div>
  </header>

  <!-- ===== DESKRIPSI TOKO ===== -->
  <section class="hero" id="tentang">
    <div class="container hero-isi">
      <div>
        <h1>Selamat datang di TokoKita</h1>
        <p>Toko online yang menyediakan fashion, elektronik, makanan khas, dan perlengkapan rumah pilihan dengan harga bersahabat. Barang dikemas rapi dan dikirim cepat ke seluruh Indonesia.</p>
        <a href="#produk" class="tombol">Mulai Belanja</a>
      </div>
      <div class="statistik">
        <div><strong>12+</strong><span>Produk</span></div>
        <div><strong>5.000+</strong><span>Pelanggan</span></div>
        <div><strong>4.8 ⭐</strong><span>Rating</span></div>
      </div>
    </div>
  </section>

  <div class="container keunggulan">
    <div><span class="ikon">🚚</span><p><strong>Pengiriman Cepat</strong><small>Ke seluruh Indonesia</small></p></div>
    <div><span class="ikon">🔒</span><p><strong>Pembayaran Aman</strong><small>Transaksi terlindungi</small></p></div>
    <div><span class="ikon">↩️</span><p><strong>Garansi Retur</strong><small>7 hari setelah diterima</small></p></div>
    <div><span class="ikon">💬</span><p><strong>Layanan 24/7</strong><small>Siap membantu</small></p></div>
  </div>

  <!-- ===== DAFTAR PRODUK ===== -->
  <main class="container bagian" id="produk">
    <h2 class="judul-bagian">Semua Produk</h2>
    <p class="sub">Scroll ke bawah untuk melihat produk pilihan kami.</p>

    <div class="toolbar">
      <input type="search" id="cari" placeholder="🔍 Cari produk...">
      <select id="urut">
        <option value="">Urutkan</option>
        <option value="murah">Harga terendah</option>
        <option value="mahal">Harga tertinggi</option>
        <option value="laris">Terlaris</option>
      </select>
    </div>
    <div class="kategori" id="kategori"></div>

    <div class="grid" id="grid"></div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="footer" id="kontak">
    <div class="container">
      <div class="footer-grid">
        <div>
          <h4>🛍️ TokoKita</h4>
          <p>Belanja online mudah, aman, dan terpercaya. Kualitas terjamin, harga bersahabat.</p>
        </div>
        <div>
          <h4>Menu</h4>
          <ul>
            <li><a href="index.html">Beranda</a></li>
            <li><a href="#produk">Produk</a></li>
            <li><a href="#tentang">Tentang Toko</a></li>
          </ul>
        </div>
        <div>
          <h4>Bantuan</h4>
          <ul>
            <li>Cara Berbelanja</li>
            <li>Pengiriman</li>
            <li>Pengembalian Barang</li>
          </ul>
        </div>
        <div>
          <h4>Kontak</h4>
          <ul>
            <li>📞 0812-3456-7890</li>
            <li>✉️ halo@tokokita.id</li>
            <li>📍 Indonesia</li>
          </ul>
        </div>
      </div>
      <div class="hak-cipta">© 2026 TokoKita. Semua hak dilindungi.</div>
    </div>
  </footer>

  <script src="data.js"></script>
  <script src="app.js"></script>
</body>
</html>
