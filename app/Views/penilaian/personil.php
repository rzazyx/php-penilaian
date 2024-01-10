<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Modal -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Personil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container"> <!-- Mengubah ke kelas container-lg -->
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="my-3">Form Nilai Personil</h2>
                </div>
                <!--error data-->
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
                <!--error data-->
                <form action="/penilaian/tambahpersonil/<?= $id; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="total" id="total" value="">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="personil" class="col-sm-3 col-form-label">Jumlah Personil sesuai RAB dan Kontrak</label>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                                <input type="number" class="form-control" id="personil1" name="personil1" value="0">
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil2" name="personil2" value="2.50" readonly>
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil3" name="personil3" value="" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="personil" class="col-sm-3 col-form-label">Komunikasi Petugas yang baik dan sopan,Ramah & beretika kepada pengguna jasa maupun stakeholders</label>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                                <input type="number" class="form-control" id="personil11" name="personil11" value="0">
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil12" name="personil12" value="2.50" readonly>
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil13" name="personil13" value="" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="personil" class="col-sm-3 col-form-label">Penampilan Petugas dan Memakai seragam dan atribut sesuai dengan ketentuan PT ASDP Indonesia Ferry (Persero)</label>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                                <input type="number" class="form-control" id="personil21" name="personil21" value="0">
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil22" name="personil22" value="2.50" readonly>
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil23" name="personil23" value="" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="personil" class="col-sm-3 col-form-label">Spesifikasi Petugas sesuai dalam KAK/TOR</label>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                                <input type="number" class="form-control" id="personil31" name="personil31" value="0">
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil32" name="personil32" value="2.50" readonly>
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil33" name="personil33" value="" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="personil" class="col-sm-3 col-form-label">Pemahaman Produk ASDP (Dibuktikan dengan lembar Test Porduct Knowledge)</label>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 6 -->
                                <input type="number" class="form-control" id="personil41" name="personil41" value="0">
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil42" name="personil42" value="2.50" readonly>
                            </div>
                            <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                <input type="number" class="form-control" id="personil43" name="personil43" value="" readonly>
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