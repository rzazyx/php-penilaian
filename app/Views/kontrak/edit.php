<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Modal -->
<div class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="my-3">Form Edit Kontrak</h2>
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

            <form action="/kontrak/update/<?= $kontrak['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="kontrak" class="col-sm-2 col-form-label">No. Kontrak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kontrak" name="no_kontrak" value="<?= $kontrak['no_kontrak']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="petugas" class="col-sm-2 col-form-label">Jenis Petugas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="petugas" name="jenis_petugas" value="<?= $kontrak['jenis_petugas']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="vendor" class="col-sm-2 col-form-label">Nama Vendor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="vendor" name="nama_vendor" value="<?= $kontrak['nama_vendor']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cabang" class="col-sm-2 col-form-label">Nama Cabang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cabang" name="nama_cabang" value="<?= $kontrak['nama_cabang']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="awal_kontrak" class="col-sm-2 col-form-label">Awal Kontrak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="awal_kontrak" name="awal_kontrak" value="<?= $kontrak['awal_kontrak']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="akhir_kontrak" class="col-sm-2 col-form-label">Akhir Kontrak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="akhir_kontrak" name="akhir_kontrak" value="<?= $kontrak['akhir_kontrak']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="file_kontrak" class="col-sm-2 col-form-label">Upload File Kontrak</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="file_kontrak" name="file_kontrak" accept="application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <a href="/cabang/index" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>