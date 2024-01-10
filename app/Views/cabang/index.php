<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Cabang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1200px;
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
                Data Cabang
            </div>
            <div class="card-body">
                <!--lokasi text pencarian-->
                <form action="/cabang/cari" method="get">
                    <div class="input-group mb-3 col-4">
                        <input type="text" class="form-control" name="katakunci" placeholder="Masukkan Nama Cabang" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
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

                <a href="/cabang/tambah" class="ml-3 btn btn-primary btn-sm mb-3">Tambah Data Cabang</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Cabang</th>
                            <th scope="col">Nama PIC</th>
                            <th scope="col">Email</th>
                            <th scope="col">No.Telp</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($cabang as $c) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $c['nama_cabang']; ?></td>
                                <td><?= $c['nama_pic']; ?></td>
                                <td><?= $c['email']; ?></td>
                                <td><?= $c['no_telp']; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="/cabang/edit/<?= $c['id']; ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="/cabang/hapus/<?= $c['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Tampilkan link paginasi -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>


</body>

</html>
<?= $this->endSection(); ?>