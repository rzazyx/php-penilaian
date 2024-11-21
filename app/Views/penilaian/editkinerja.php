<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="my-3">Edit Nilai Kinerja</h2>
            </div>

            <!-- Tampilkan pesan error jika ada -->
            <?php if (session('validation')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        <?php foreach (session('validation')->getErrors() as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="/penilaian/updatekinerja/<?= $penilaian['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="total" id="total" value="">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">Memastikan pengawasan agar petugas Selalu standby di pos jaga ketika bertugas</label>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                            <input type="number" class="form-control" id="personil1" name="personil1" value="<?= $penilaian['kinerja1']; ?>">
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil2" name="personil2" value="6.00" readonly>
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil3" name="personil3" value="" readonly>
                        </div>
                        <div class="mb-3 row">
                            <label for="g_kinerja1" class="col-sm-3 col-form-label">Gambar Personil 1</label>
                            <div class="col-sm-9">
                                <!-- Tambahkan logika PHP untuk menampilkan gambar jika tersedia -->
                                <?php if (!empty($penilaian['gambar_kinerja1'])) : ?>
                                    <!-- Tampilkan gambar yang sudah diunggah sebelumnya -->
                                    <img src="/public/uploads/<?= $penilaian['gambar_kinerja1']; ?>" class="img-thumbnail" alt="Gambar Personil 1" width="100">
                                <?php else : ?>
                                    <!-- Tampilkan pesan jika gambar tidak tersedia -->
                                    <p>Gambar tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sedikan opsi untuk mengunggah gambar baru -->
                        <div class="mb-3 row">
                            <label for="g_kinerja1" class="col-sm-3 col-form-label">Unggah Gambar Baru</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="g_kinerja1" name="g_kinerja1">
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">Melaksanakan tugas pokok sesuai dengan plotting dan job description masing-masing</label>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                            <input type="number" class="form-control" id="personil11" name="personil11" value="<?= $penilaian['kinerja2']; ?>">
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil12" name="personil12" value="3.50" readonly>
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil13" name="personil13" value="" readonly>
                        </div>
                        <div class="mb-3 row">
                            <label for="g_kinerja2" class="col-sm-3 col-form-label">Gambar Personil 1</label>
                            <div class="col-sm-9">
                                <!-- Tambahkan logika PHP untuk menampilkan gambar jika tersedia -->
                                <?php if (!empty($penilaian['gambar_kinerja2'])) : ?>
                                    <!-- Tampilkan gambar yang sudah diunggah sebelumnya -->
                                    <img src="/public/uploads/<?= $penilaian['gambar_kinerja2']; ?>" class="img-thumbnail" alt="Gambar Personil 1" width="100">
                                <?php else : ?>
                                    <!-- Tampilkan pesan jika gambar tidak tersedia -->
                                    <p>Gambar tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sedikan opsi untuk mengunggah gambar baru -->
                        <div class="mb-3 row">
                            <label for="g_kinerja2" class="col-sm-3 col-form-label">Unggah Gambar Baru</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="g_kinerja2" name="g_kinerja2">
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">Prosedur demo alat keselamatan dan standar announcement dilakukan pada setiap trip</label>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                            <input type="number" class="form-control" id="personil21" name="personil21" value="<?= $penilaian['kinerja3']; ?>">
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil22" name="personil22" value="11.50" readonly>
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil23" name="personil23" value="" readonly>
                        </div>
                        <div class="mb-3 row">
                            <label for="g_kinerja3" class="col-sm-3 col-form-label">Gambar Personil 1</label>
                            <div class="col-sm-9">
                                <!-- Tambahkan logika PHP untuk menampilkan gambar jika tersedia -->
                                <?php if (!empty($penilaian['gambar_kinerja3'])) : ?>
                                    <!-- Tampilkan gambar yang sudah diunggah sebelumnya -->
                                    <img src="/public/uploads/<?= $penilaian['gambar_kinerja3']; ?>" class="img-thumbnail" alt="Gambar Personil 1" width="100">
                                <?php else : ?>
                                    <!-- Tampilkan pesan jika gambar tidak tersedia -->
                                    <p>Gambar tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sedikan opsi untuk mengunggah gambar baru -->
                        <div class="mb-3 row">
                            <label for="g_kinerja3" class="col-sm-3 col-form-label">Unggah Gambar Baru</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="g_kinerja3" name="g_kinerja3">
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">Memastikan seluruh Komplain yang terjadi di kapal mendapatkan initial response terekskalasi sesuai tupoksi.</label>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                            <input type="number" class="form-control" id="personil31" name="personil31" value="<?= $penilaian['kinerja4']; ?>">
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil32" name="personil32" value="11.50" readonly>
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil33" name="personil33" value="" readonly>
                        </div>
                        <div class="mb-3 row">
                            <label for="g_kinerja4" class="col-sm-3 col-form-label">Gambar Personil 1</label>
                            <div class="col-sm-9">
                                <!-- Tambahkan logika PHP untuk menampilkan gambar jika tersedia -->
                                <?php if (!empty($penilaian['gambar_kinerja4'])) : ?>
                                    <!-- Tampilkan gambar yang sudah diunggah sebelumnya -->
                                    <img src="/public/uploads/<?= $penilaian['gambar_kinerja4']; ?>" class="img-thumbnail" alt="Gambar Personil 1" width="100">
                                <?php else : ?>
                                    <!-- Tampilkan pesan jika gambar tidak tersedia -->
                                    <p>Gambar tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sedikan opsi untuk mengunggah gambar baru -->
                        <div class="mb-3 row">
                            <label for="g_kinerja4" class="col-sm-3 col-form-label">Unggah Gambar Baru</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="g_kinerja4" name="g_kinerja4">
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">'Turut melakukan pengawasan terhadap Asset Perusahaan & Fasilitas Pengguna jasa dan melaporkan pada kesempatan pertama jika terdapat potensi yang dapat menyebabkan kerusakan/kehilangan</label>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                            <input type="number" class="form-control" id="personil41" name="personil41" value="<?= $penilaian['kinerja5']; ?>">
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil42" name="personil42" value="10.00" readonly>
                        </div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="personil43" name="personil43" value="" readonly>
                        </div>
                        <div class="mb-3 row">
                            <label for="g_kinerja5" class="col-sm-3 col-form-label">Gambar Personil 1</label>
                            <div class="col-sm-9">
                                <!-- Tambahkan logika PHP untuk menampilkan gambar jika tersedia -->
                                <?php if (!empty($penilaian['gambar_kinerja5'])) : ?>
                                    <!-- Tampilkan gambar yang sudah diunggah sebelumnya -->
                                    <img src="/public/uploads/<?= $penilaian['gambar_kinerja5']; ?>" class="img-thumbnail" alt="Gambar Personil 1" width="100">
                                <?php else : ?>
                                    <!-- Tampilkan pesan jika gambar tidak tersedia -->
                                    <p>Gambar tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sedikan opsi untuk mengunggah gambar baru -->
                        <div class="mb-3 row">
                            <label for="g_kinerja5" class="col-sm-3 col-form-label">Unggah Gambar Baru</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="g_kinerja5" name="g_kinerja5">
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="mb-3 row">
                        <label for="personil" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                            <input type="number" class="form-control" id="totalDisplay" name="total" value="" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <a href="/penilaian/index" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</body>

<script>
    // Mendapatkan referensi ke elemen-elemen input
    var inputPersonil1 = document.getElementById('personil1');
    var inputPersonil2 = document.getElementById('personil2');
    var inputPersonil3 = document.getElementById('personil3');

    var inputPersonil11 = document.getElementById('personil11');
    var inputPersonil12 = document.getElementById('personil12');
    var inputPersonil13 = document.getElementById('personil13');

    var inputPersonil21 = document.getElementById('personil21');
    var inputPersonil22 = document.getElementById('personil22');
    var inputPersonil23 = document.getElementById('personil23');

    var inputPersonil31 = document.getElementById('personil31');
    var inputPersonil32 = document.getElementById('personil32');
    var inputPersonil33 = document.getElementById('personil33');

    var inputPersonil41 = document.getElementById('personil41');
    var inputPersonil42 = document.getElementById('personil42');
    var inputPersonil43 = document.getElementById('personil43');

    var inputTotal = document.getElementById('total');

    // Menambahkan event listener untuk menghitung hasil perkalian saat nilai diubah
    inputPersonil1.addEventListener('input', updateResult);
    inputPersonil11.addEventListener('input', updateResult1);
    inputPersonil21.addEventListener('input', updateResult2);
    inputPersonil31.addEventListener('input', updateResult3);
    inputPersonil41.addEventListener('input', updateResult4);

    function updateResult() {
        // Menghitung hasil perkalian
        var result = parseFloat(inputPersonil1.value) * parseFloat(inputPersonil2.value) / 100;

        // Menetapkan hasilnya sebagai nilai pada input ketiga
        inputPersonil3.value = result;

        // Memanggil fungsi untuk mengupdate total
        updateTotal();
    }

    function updateResult1() {
        // Menghitung hasil perkalian
        var result = parseFloat(inputPersonil11.value) * parseFloat(inputPersonil12.value) / 100;

        // Menetapkan hasilnya sebagai nilai pada input ketiga
        inputPersonil13.value = result;

        // Memanggil fungsi untuk mengupdate total
        updateTotal();
    }

    function updateResult2() {
        // Menghitung hasil perkalian
        var result = parseFloat(inputPersonil21.value) * parseFloat(inputPersonil22.value) / 100;

        // Menetapkan hasilnya sebagai nilai pada input ketiga
        inputPersonil23.value = result;

        // Memanggil fungsi untuk mengupdate total
        updateTotal();
    }

    function updateResult3() {
        // Menghitung hasil perkalian
        var result = parseFloat(inputPersonil31.value) * parseFloat(inputPersonil32.value) / 100;

        // Menetapkan hasilnya sebagai nilai pada input ketiga
        inputPersonil33.value = result;

        // Memanggil fungsi untuk mengupdate total
        updateTotal();
    }

    function updateResult4() {
        // Menghitung hasil perkalian
        var result = parseFloat(inputPersonil41.value) * parseFloat(inputPersonil42.value) / 100;

        // Menetapkan hasilnya sebagai nilai pada input ketiga
        inputPersonil43.value = result;

        // Memanggil fungsi untuk mengupdate total
        updateTotal();
    }

    function updateTotal() {
        // Menghitung total dari semua hasil
        var total = parseFloat(inputPersonil3.value || 0) +
            parseFloat(inputPersonil13.value || 0) +
            parseFloat(inputPersonil23.value || 0) +
            parseFloat(inputPersonil33.value || 0) +
            parseFloat(inputPersonil43.value || 0);

        // Menetapkan total sebagai nilai pada input total
        inputTotal.value = total;

        // Menetapkan total sebagai nilai pada input totalDisplay (untuk ditampilkan kepada pengguna)
        document.getElementById('totalDisplay').value = total;
    }
</script>

</html>
<?= $this->endSection(); ?>