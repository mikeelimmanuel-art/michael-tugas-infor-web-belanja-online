<?php /** Satu kartu produk. Variabel: $p (data produk) */ ?>
<article class="produk" data-nama="<?= esc(mb_strtolower($p['nama'] . ' ' . $p['ket']), 'attr') ?>" data-kategori="<?= esc($p['kategori'], 'attr') ?>">
    <div class="foto" style="background: <?= esc($p['warna'], 'attr') ?>">
        <?php if (! empty($p['foto'])): ?>
            <img src="<?= base_url($p['foto']) ?>" alt="<?= esc($p['nama'], 'attr') ?>">
        <?php else: ?>
            <span aria-hidden="true"><?= $p['ikon'] ?></span>
        <?php endif; ?>
    </div>
    <div class="produk-isi">
        <h3 class="produk-nama"><?= esc($p['nama']) ?></h3>
        <p class="produk-ket"><?= esc($p['ket']) ?></p>
        <div class="produk-bawah">
            <span class="harga">Rp<?= number_format($p['harga'], 0, ',', '.') ?></span>
            <button class="btn-tambah"
                    data-id="<?= (int) $p['id'] ?>"
                    data-nama="<?= esc($p['nama'], 'attr') ?>"
                    data-harga="<?= (int) $p['harga'] ?>">
                Tambah ke keranjang
            </button>
        </div>
    </div>
</article>
