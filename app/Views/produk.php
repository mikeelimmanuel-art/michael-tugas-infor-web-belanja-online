<?= $this->extend('layout/utama') ?>

<?= $this->section('header') ?>
    <div class="header-isi">
        <a class="kembali" href="<?= site_url('beranda') ?>">&larr; Kembali ke beranda</a>
        <h1 class="judul-halaman">Semua produk</h1>
        <p class="sub"><?= count($produk) ?> produk dari pengrajin dan petani lokal.</p>
    </div>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<!-- Bilah cari dan filter. Menempel di atas saat halaman di-scroll. -->
<div class="bilah-filter">
    <div class="bilah-isi">
        <label class="sr-saja" for="cariProduk">Cari produk</label>
        <input type="search" id="cariProduk" class="input-cari" placeholder="Cari produk, misalnya kopi..." autocomplete="off">
        <div class="chip-daftar" id="chipKategori" role="group" aria-label="Filter kategori">
            <button type="button" class="chip aktif" data-kategori="">Semua</button>
            <?php foreach ($kategori as $k): ?>
                <button type="button" class="chip" data-kategori="<?= esc($k, 'attr') ?>"><?= esc($k) ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<main>
    <p class="info-hasil" id="infoHasil" aria-live="polite"></p>
    <div class="grid-produk" id="gridProduk">
        <?php foreach ($produk as $p): ?>
            <?= view('partials/kartu_produk', ['p' => $p]) ?>
        <?php endforeach; ?>
    </div>
    <p class="kosong-cari" id="kosongCari" hidden>Tidak ada produk yang cocok. Coba kata kunci atau kategori lain.</p>
</main>
<?= $this->endSection() ?>

<?= $this->section('skrip') ?>
<script src="<?= base_url('js/produk.js') ?>"></script>
<?= $this->endSection() ?>
