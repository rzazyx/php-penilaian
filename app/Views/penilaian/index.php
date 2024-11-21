<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<style>
    .container {
        max-width: 1500px;
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Penilaian
            </div>
            <div class="card-body">
                <!--lokasi text pencarian-->
                <form action="<?= base_url('penilaiancontroller/search'); ?>" method="get">
                    <div class="input-group mb-3 col-4">
                        <input type="text" class="form-control" name="katakunci" placeholder="Masukkan Nama Vendor, Nama Cabang, No Kontrak, atau Bulan" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>

                <div class="d-flex justify-content-end mt-3"> <!-- Add mt-3 (margin-top: 3) for spacing -->
                    <a href="<?= base_url('/penilaian/cetakPDF'); ?>" class="btn btn-primary me-2">Cetak</a> <!-- Add me-2 (margin-right: 2) for spacing -->
                    <a href="<?= base_url('/penilaian/laporan'); ?>" class="btn btn-secondary">Laporan</a>
                </div>

                <!-- <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-primary" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?> -->

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Kontrak</th>
                            <th scope="col">Jenis Petugas</th>
                            <th scope="col">Nama Vendor</th>
                            <th scope="col">Nama Cabang</th>
                            <th scope="col">Tanggal Penilaian</th>
                            <th scope="col">Score Personil</th>
                            <th scope="col">Score Kinerja</th>
                            <th scope="col">Score Manajemen Mitra</th>
                            <th scope="col">Score Material dan Machine</th>
                            <th scope="col">Score Kedisipilnan</th>
                            <th scope="col">Score Fatal Error</th>
                            <th scope="col">Total Nilai</th>
                            <?php if (session()->user_level == 'admin' || session()->user_level == 'pic') { ?>
                                <th scope="col">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tampilkan data penilaian di sini -->
                        <!-- Gunakan loop untuk menampilkan data -->
                        <?php $no = 1;
                        foreach ($penilaian as $penilaian) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $penilaian['no_kontrak']; ?></td>
                                <td><?= $penilaian['jenis_petugas']; ?></td>
                                <td><?= $penilaian['nama_vendor']; ?></td>
                                <td><?= $penilaian['nama_cabang']; ?></td>
                                <td>
                                    <?php if ($penilaian['tanggal'] == null) : ?>
                                        <p>Belum Dinilai</p>
                                    <?php else : ?>
                                        <?= $penilaian['tanggal']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['personil'] == 0) : ?>
                                        <a href="/penilaian/personil/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['personil']; ?>
                                        <a href="/penilaian/editpersonil/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">Edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['kinerja'] == 0) : ?>
                                        <a href="/penilaian/kinerja/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['kinerja']; ?>
                                        <a href="/penilaian/editkinerja/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">Edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['m_mitra'] == 0) : ?>
                                        <a href="/penilaian/m_mitra/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['m_mitra']; ?>
                                        <a href="/penilaian/editmitra/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">Edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['material'] == 0) : ?>
                                        <a href="/penilaian/material/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['material']; ?>
                                        <a href="/penilaian/editmaterial/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">edit</a>
                                        <!-- <a href="/penilaian/viewmaterial/<?= $penilaian['id']; ?>" class="bbi bi-eye-fill">view</a>-->
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['kedisiplinan'] == 0) : ?>
                                        <a href="/penilaian/kedisiplinan/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['kedisiplinan']; ?>
                                        <a href="/penilaian/editdisiplin/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($penilaian['fatal_error'] == 0) : ?>
                                        <a href="/penilaian/fatal_error/<?= $penilaian['id']; ?>"><i class="fas fa-edit"></i></a>
                                    <?php else : ?>
                                        <?= $penilaian['fatal_error']; ?>
                                        <a href="/penilaian/editfatal/<?= $penilaian['id']; ?>" class="bi bi-eye-fill">edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $penilaian['personil'] + $penilaian['kinerja'] + $penilaian['m_mitra'] + $penilaian['material'] + $penilaian['kedisiplinan'] + $penilaian['fatal_error']; ?>
                                </td>
                                <?php if (session()->user_level == 'admin' || session()->user_level == 'pic') { ?>
                                    <!--<td>
                                        <a href="/penilaian/hapus/<?= $penilaian['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </a>
                                    </td>-->
                                    <td>
                                        <?php if ($penilaian['personil'] > 0 || $penilaian['kinerja'] > 0 || $penilaian['m_mitra'] > 0 || $penilaian['material'] > 0 || $penilaian['kedisiplinan'] > 0 || $penilaian['fatal_error'] > 0) : ?>
                                            <a href="/penilaian/reset/<?= $penilaian['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                                <button class="btn btn-warning btn-sm">Penilaian Selanjutnya</button>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php } ?>
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
                </nav>
            </div>
        </div>
    </div>

</html>

<?= $this->endSection(); ?>