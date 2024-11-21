<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Modal -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Material dan Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container"> <!-- Mengubah ke kelas container-lg -->
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="my-3">Form Nilai Material dan Machine</h2>
                </div>

                <body>
                    <div class="container mt-5">

                        <h2>Edit Material</h2>
                        <form action="/penilaian/updatematerial/<?= $id; ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="total" id="total" value="">
                            <div class="mb-3 row">
                                <label for="personil" class="col-sm-3 col-form-label">Ketersediaan Perlengkapan dan Material pendukung pekerjaan petugas Tiketing</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="personil1" name="personil1" value="<?= $penilaian['nilai_material']; ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="personil2" name="personil2" value="6.0" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="personil3" name="personil3" value="" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar" class="col-sm-3 col-form-label">Bukti Pelanggaran</label>
                                <div class="col-sm-9">
                                    <?php if (!empty($penilaian['gambar_material'])) : ?>
                                        <img src="/public/uploads/<?= $penilaian['gambar_material']; ?>" class="img-thumbnail" alt="Gambar Material">
                                    <?php else : ?>
                                        <p>Gambar tidak tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <hr class="my-4">

                            <div class="mb-3 row">
                                <label for="personil" class="col-sm-3 col-form-label">Total</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"> <!-- Mengubah lebar kolom menjadi 3 -->
                                    <input type="number" class="form-control" id="totalDisplay" name="total" value="<?= $penilaian['material']; ?>" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="/penilaian/index" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </body>
                <script>
                    // Mendapatkan referensi ke elemen-elemen input
                    var inputPersonil1 = document.getElementById('personil1');
                    var inputPersonil2 = document.getElementById('personil2');
                    var inputPersonil3 = document.getElementById('personil3');

                    var inputTotal = document.getElementById('total');

                    // Menambahkan event listener untuk menghitung hasil perkalian saat nilai diubah
                    inputPersonil1.addEventListener('input', updateResult);
                    inputPersonil11.addEventListener('input', updateResult1);
                    inputPersonil21.addEventListener('input', updateResult2);

                    function updateResult() {
                        // Menghitung hasil perkalian
                        var result = parseFloat(inputPersonil1.value) * parseFloat(inputPersonil2.value) / 100;

                        // Menetapkan hasilnya sebagai nilai pada input ketiga
                        inputPersonil3.value = result;

                        // Memanggil fungsi untuk mengupdate total
                        updateTotal();
                    }

                    function updateTotal() {
                        // Menghitung total dari semua hasil
                        var total = parseFloat(inputPersonil3.value || 0);

                        // Menetapkan total sebagai nilai pada input total
                        inputTotal.value = total;

                        // Menetapkan total sebagai nilai pada input totalDisplay (untuk ditampilkan kepada pengguna)
                        document.getElementById('totalDisplay').value = total;
                    }
                </script>

</html>
<?= $this->endSection(); ?>