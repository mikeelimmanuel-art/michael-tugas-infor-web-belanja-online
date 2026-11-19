(function () {
    // ---------- Menu pengaturan ----------
    var btnPengaturan = document.getElementById('btnPengaturan');
    var menu = document.getElementById('menuPengaturan');

    function toggleMenu(buka) {
        menu.hidden = !buka;
        btnPengaturan.setAttribute('aria-expanded', buka ? 'true' : 'false');
    }
    btnPengaturan.addEventListener('click', function (ev) {
        ev.stopPropagation();
        toggleMenu(menu.hidden);
    });
    document.addEventListener('click', function (ev) {
        if (!menu.hidden && !menu.contains(ev.target)) toggleMenu(false);
    });

    // ---------- Keranjang ----------
    var KUNCI = 'keranjang_toko';
    var keranjang = {};
    try { keranjang = JSON.parse(localStorage.getItem(KUNCI)) || {}; } catch (e) { keranjang = {}; }

    var panel = document.getElementById('panelKeranjang');
    var lapisan = document.getElementById('lapisan');
    var daftar = document.getElementById('daftarKeranjang');
    var badge = document.getElementById('badgeKeranjang');
    var totalEl = document.getElementById('totalHarga');
    var btnBayar = document.getElementById('btnBayar');

    function rupiah(n) { return 'Rp' + n.toLocaleString('id-ID'); }
    function simpan() { try { localStorage.setItem(KUNCI, JSON.stringify(keranjang)); } catch (e) {} }

    function bukaPanel(buka) {
        panel.classList.toggle('buka', buka);
        panel.setAttribute('aria-hidden', buka ? 'false' : 'true');
        lapisan.hidden = !buka;
    }

    function gambar() {
        var ids = Object.keys(keranjang), jumlahTotal = 0, harga = 0;
        daftar.innerHTML = '';

        if (!ids.length) {
            daftar.innerHTML = '<p class="kosong">Keranjang masih kosong. Pilih produk lalu tekan "Tambah ke keranjang".</p>';
        }
        ids.forEach(function (id) {
            var it = keranjang[id];
            jumlahTotal += it.qty;
            harga += it.qty * it.harga;

            var baris = document.createElement('div');
            baris.className = 'baris';

            var nama = document.createElement('div');
            nama.className = 'baris-nama';
            nama.textContent = it.nama;

            var info = document.createElement('div');
            info.className = 'baris-harga';
            info.textContent = rupiah(it.harga) + ' x ' + it.qty;

            var ctrl = document.createElement('div');
            ctrl.className = 'jumlah';
            ctrl.innerHTML = '<button aria-label="Kurangi">-</button><span>' + it.qty + '</span><button aria-label="Tambah">+</button>';
            ctrl.children[0].onclick = function () { ubah(id, -1); };
            ctrl.children[2].onclick = function () { ubah(id, 1); };

            baris.appendChild(nama);
            baris.appendChild(ctrl);
            baris.appendChild(info);
            daftar.appendChild(baris);
        });

        badge.textContent = jumlahTotal;
        badge.hidden = jumlahTotal === 0;
        totalEl.textContent = rupiah(harga);
        btnBayar.disabled = jumlahTotal === 0;
    }

    function ubah(id, selisih) {
        if (!keranjang[id]) return;
        keranjang[id].qty += selisih;
        if (keranjang[id].qty <= 0) delete keranjang[id];
        simpan(); gambar();
    }

    document.querySelectorAll('.btn-tambah').forEach(function (tombol) {
        tombol.addEventListener('click', function () {
            var id = tombol.dataset.id;
            if (!keranjang[id]) {
                keranjang[id] = { nama: tombol.dataset.nama, harga: parseInt(tombol.dataset.harga, 10), qty: 0 };
            }
            keranjang[id].qty++;
            simpan(); gambar();
            bukaPanel(true);
        });
    });

    document.getElementById('btnKeranjang').addEventListener('click', function () { bukaPanel(true); });
    document.getElementById('btnTutup').addEventListener('click', function () { bukaPanel(false); });
    lapisan.addEventListener('click', function () { bukaPanel(false); });
    document.addEventListener('keydown', function (ev) {
        if (ev.key === 'Escape') { bukaPanel(false); toggleMenu(false); }
    });

    gambar();
})();
