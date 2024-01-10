<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Modal -->
<div class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="my-3">Form Edit Cabang</h2>
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

            <form action="/cabang/update/<?= $cabang['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="cabang" class="col-sm-2 col-form-label">Nama Cabang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cabang" name="nama_cabang" value="<?= $cabang['nama_cabang']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pic" class="col-sm-2 col-form-label">Nama PIC</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pic" name="nama_pic" value="<?= $cabang['nama_pic']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Input Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $cabang['email']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telp" class="col-sm-2 col-form-label">No. Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telp" name="no_telp" value=" <?= $cabang['no_telp']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                        </div>
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