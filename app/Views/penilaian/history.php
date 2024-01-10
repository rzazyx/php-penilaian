<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1200px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                History Penilaian
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Kontrak</th>
                            <th scope="col">Jenis Petugas</th>
                            <th scope="col">Nama Vendor</th>
                            <th scope="col">Nama Cabang</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tampilkan data penilaian di sini -->
                        <!-- Gunakan loop untuk menampilkan data -->
                        <?php $no = 1;
                        foreach ($history as $histori) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $histori['no_kontrak']; ?></td>
                                <td><?= $histori['jenis_petugas']; ?></td>
                                <td><?= $histori['nama_vendor']; ?></td>
                                <td><?= $histori['nama_cabang']; ?></td>
                                <td><?= $histori['waktu_upload']; ?></td>

                                <td>
                                    <!-- Tambahkan tombol aksi sesuai kebutuhan -->
                                    <a href="<?= base_url('penilaian/download/' . $histori['id']); ?>" class="btn btn-info btn-sm">Download</a>
                                    <!-- <a href="<?= base_url('penilaian/edit/' . $histori['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('penilaian/delete/' . $histori['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?= $this->endSection(); ?>