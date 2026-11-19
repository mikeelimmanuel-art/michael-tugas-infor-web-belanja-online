(function () {
    var kotak = document.getElementById('cariProduk');
    var chips = document.querySelectorAll('#chipKategori .chip');
    var kartu = document.querySelectorAll('#gridProduk .produk');
    var info = document.getElementById('infoHasil');
    var kosong = document.getElementById('kosongCari');
    var kategoriAktif = '';

    function saring() {
        var kata = kotak.value.trim().toLowerCase();
        var tampil = 0;
        kartu.forEach(function (k) {
            var cocokKata = !kata || k.dataset.nama.indexOf(kata) !== -1;
            var cocokKat = !kategoriAktif || k.dataset.kategori === kategoriAktif;
            var ok = cocokKata && cocokKat;
            k.hidden = !ok;
            if (ok) tampil++;
        });
        kosong.hidden = tampil !== 0;
        info.textContent = (kata || kategoriAktif) ? 'Menampilkan ' + tampil + ' dari ' + kartu.length + ' produk' : '';
    }

    kotak.addEventListener('input', saring);
    chips.forEach(function (c) {
        c.addEventListener('click', function () {
            chips.forEach(function (x) { x.classList.remove('aktif'); x.setAttribute('aria-pressed', 'false'); });
            c.classList.add('aktif');
            c.setAttribute('aria-pressed', 'true');
            kategoriAktif = c.dataset.kategori;
            saring();
        });
    });
})();
