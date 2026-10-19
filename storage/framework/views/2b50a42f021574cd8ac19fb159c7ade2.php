
<script>
    /*
     * Kartu tetap berukuran asli 85 x 55 mm; hanya tampilannya yang diskalakan.
     * Di layar lebar kartu sedikit diperbesar, di layar sempit diperkecil, dan
     * proporsinya tetap 85:55 sehingga tidak pernah melenceng.
     * Batas MAKS_SKALA mencegah kartu membesar berlebihan di monitor besar.
     */
    (function () {
        var MAKS_SKALA = 1.45;

        var sesuaikan = function (wadah) {
            var kartu = wadah.querySelector('.kartu');
            if (!kartu) return;

            // Lebar yang tersedia diambil dari blok induknya, bukan dari
            // pembungkus sendiri: pembungkus lebarnya disetel di bawah ini,
            // jadi mengukurnya akan membuat skala menyusut terus setiap resize.
            var induk = wadah.parentElement;
            var tersedia = induk ? induk.clientWidth : wadah.clientWidth;
            if (!tersedia) return;

            var skala = Math.min(MAKS_SKALA, tersedia / kartu.offsetWidth);

            // Jangan memasang transform saat skala tepat 1: transform identitas
            // tetap membuat lapisan kompositing dan mengubah cara browser
            // merender antialias teks, sehingga pratinjau bisa terlihat sedikit
            // berbeda dari cetakan.
            kartu.style.transform = skala === 1 ? 'none' : 'scale(' + skala + ')';
            // Pembungkus ikut ukuran kartu supaya tidak ada ruang kosong maupun
            // bagian kartu yang terpotong.
            wadah.style.width = (kartu.offsetWidth * skala) + 'px';
            wadah.style.height = (kartu.offsetHeight * skala) + 'px';
        };

        var semuaWadah = Array.prototype.slice.call(document.querySelectorAll('[data-kartu-skala]'));
        if (!semuaWadah.length) return;

        var sesuaikanSemua = function () {
            semuaWadah.forEach(sesuaikan);
        };

        sesuaikanSemua();
        window.addEventListener('resize', sesuaikanSemua);

        // Hitung ulang bila gambar anggota atau font belum selesai dimuat.
        semuaWadah.forEach(function (wadah) {
            var gambar = wadah.querySelectorAll('img');
            Array.prototype.forEach.call(gambar, function (el) {
                if (!el.complete) {
                    el.addEventListener('load', sesuaikanSemua);
                    el.addEventListener('error', sesuaikanSemua);
                }
            });
        });
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(sesuaikanSemua);
        }
    })();
</script>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/partials/kartu-anggota-script.blade.php ENDPATH**/ ?>