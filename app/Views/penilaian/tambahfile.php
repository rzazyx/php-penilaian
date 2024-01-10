<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Modal -->
<div class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="my-3">Form Uplload File Penilaian</h2>
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

            <form action="<?= base_url('penilaian/update/' . $kontrakId); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="no_kontrak" id="no_kontrak" value="<?= $kontrak['no_kontrak']; ?>">
                <input type="hidden" name="jenis_petugas" id="jenis_petugas" value="<?= $kontrak['jenis_petugas']; ?>">
                <input type="hidden" name="nama_vendor" id="nama_vendor" value="<?= $kontrak['nama_vendor']; ?>">
                <input type="hidden" name="nama_cabang" id="nama_cabang" value="<?= $kontrak['nama_cabang']; ?>">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="file_penilaian" class="col-sm-2 col-form-label">Upload File </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="file_penilaian" name="file_penilaian" accept="application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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


<?= $this->endSection(); ?>