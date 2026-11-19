<?= $this->extend('layout/utama') ?>

<?= $this->section('header') ?>
    <div class="header-isi">
        <a class="kembali" href="<?= site_url('beranda') ?>">&larr; Kembali ke beranda</a>
        <h1 class="judul-halaman">Kontak kami</h1>
        <p class="sub">Ada pertanyaan soal pesanan atau produk? Kami senang membantu.</p>
    </div>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<main class="lebar-kontak">
    <!-- Informasi toko (bebas diganti) -->
    <section class="blok">
        <h2>Hubungi kami</h2>
        <dl class="info-kontak">
            <dt>Alamat</dt>
            <dd><?= esc($kontak['alamat']) ?></dd>
            <dt>Telepon / WhatsApp</dt>
            <dd><?= esc($kontak['telepon']) ?></dd>
            <dt>Email</dt>
            <dd><a href="mailto:<?= esc($kontak['email'], 'attr') ?>"><?= esc($kontak['email']) ?></a></dd>
            <dt>Jam layanan</dt>
            <dd><?= esc($kontak['jam']) ?></dd>
        </dl>
    </section>

    <!-- Form kirim pesan -->
    <section class="blok">
        <h2>Kirim pesan</h2>

        <?php if (session()->getFlashdata('sukses')): ?>
            <div class="pesan sukses" role="status"><?= esc(session()->getFlashdata('sukses')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="pesan error" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('kontak/kirim') ?>">
            <?= csrf_field() ?>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= esc(old('nama', $namaPengguna === 'User' ? '' : $namaPengguna), 'attr') ?>" required maxlength="80">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= esc(old('email'), 'attr') ?>" required maxlength="120">

            <label for="pesan">Pesan</label>
            <textarea id="pesan" name="pesan" rows="5" required minlength="10" maxlength="2000"><?= esc(old('pesan')) ?></textarea>

            <button type="submit" class="btn-utama">Kirim pesan</button>
        </form>
    </section>
</main>
<?= $this->endSection() ?>
