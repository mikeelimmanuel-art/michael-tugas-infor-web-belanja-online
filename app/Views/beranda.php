<?= $this->extend('layout/utama') ?>

<?= $this->section('header') ?>
    <div class="header-isi" id="beranda">
        <h1 class="nama-toko"><?= esc($namaToko) ?></h1>
        <p class="keterangan-toko"><?= esc($keterangan) ?></p>
    </div>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<main>
    <h2 class="judul-bagian">Produk pilihan</h2>
    <div class="grid-produk">
        <?php foreach ($produk as $p): ?>
            <?= view('partials/kartu_produk', ['p' => $p]) ?>
        <?php endforeach; ?>
    </div>
    <p class="lihat-semua"><a class="btn-utama" href="<?= site_url('produk') ?>">Lihat semua produk</a></p>
</main>
<?= $this->endSection() ?>
