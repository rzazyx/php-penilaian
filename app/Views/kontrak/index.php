<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kontrak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1500px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!--container-->
    <div class="container">
        <!--card-->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Kontrak
            </div>
            <div class="card-body container-fluid">
                <!--lokasi text pencarian-->
                <form action="/kontrak/index" method="get">
                    <div class="input-group mb-3 col-4">
                        <input type="text" class="form-control" name="katakunci" placeholder="Search by No. Kontrak, cabang, vendor" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari</button>
                    </div>
                </form>
                <!--modal tambah-->
                <!-- Button trigger modal -->

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-primary" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->user_level == 'admin') { ?>
                    <a href="/kontrak/tambah" class="ml-3 btn btn-primary btn-sm">Tambah Data Kontrak</a>

                <?php } ?>

                <a href="/kontrak/cetakPDF" class="ml-3 btn btn-success btn-sm">Cetak Data</a>
                <!-- Replace "NamaCabang" with the actual branch name -->


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Kontrak</th>
                            <th scope="col">Jenis Petugas</th>
                            <th scope="col">Nama Vendor</th>
                            <th scope="col">Nama Cabang</th>
                            <th scope="col">Awal Kontrak</th>
                            <th scope="col">Akhir Kontrak</th>
                            <th scope="col">Sisa Waktu (hari)</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">File Kontrak</th>
                            <th scope="col">Status</th>
                            <?php if (session()->user_level == 'admin') { ?>
                                <th scope="col">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kontrak as $kontrak) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $kontrak['no_kontrak']; ?></td>
                                <td><?= $kontrak['jenis_petugas']; ?></td>
                                <td><?= $kontrak['nama_vendor']; ?></td>
                                <td><?= $kontrak['nama_cabang']; ?></td>
                                <td><?= $kontrak['awal_kontrak']; ?></td>
                                <td><?= $kontrak['akhir_kontrak']; ?></td>
                                <td><?= $kontrak['sisa_waktu']; ?></td>
                                <td><?= $kontrak['keterangan']; ?></td>
                                <td>
                                    <?php if (!empty($kontrak['file_kontrak'])) : ?>
                                        <a href="/uploads/kontrak/<?= $kontrak['file_kontrak']; ?>" target="_blank">lihat</a>
                                        <a href="/uploads/kontrak/<?= $kontrak['file_kontrak']; ?>" download>Unduh</a>
                                    <?php else : ?>
                                        <!-- Tindakan jika tidak ada file kontrak -->
                                        Tidak Ada File
                                    <?php endif; ?>
                                </td>
                                <td><?= $kontrak['status'] == 'aktif' ? 'Aktif' : 'Nonaktif'; ?></td>

                                <?php if (session()->user_level == 'admin') { ?>
                                    <td>
                                        <?php if ($kontrak['status'] == 'aktif') : ?>
                                            <!-- Tombol Nonaktif jika status aktif -->
                                            <a class="btn btn-danger btn-sm" href="/kontrak/nonaktifkan/<?= $kontrak['id']; ?>">Nonaktifkan</a>
                                        <?php else : ?>
                                            <!-- Tombol Aktifkan jika status nonaktif -->
                                            <a class="btn btn-success btn-sm" href="/kontrak/aktifkan/<?= $kontrak['id']; ?>">Aktifkan</a>
                                        <?php endif; ?>
                                        <a class="btn btn-warning btn-sm" href="/kontrak/edit/<?= $kontrak['id']; ?>">Edit</a>
                                    </td>

                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


</body>

</html>
<?= $this->endSection(); ?>