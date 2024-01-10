<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                                <?php endif; ?>
                                <!-- Hapus form yang menduplikasi -->
                                <div class="form-group">
                                    <form action="/LoginController/login" method="POST">
                                        <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name='password' id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                                </form> <!-- Tutup form disini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>