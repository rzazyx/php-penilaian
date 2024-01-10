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
                                <?= form_open('LoginController/cekUser'); ?>
                                <?= csrf_field(); ?>
                                <!-- Hapus form yang menduplikasi -->
                                <div class="form-group">
                                    <?php
                                    //if (session()->getFlashdata('errEmail')) {
                                    //$isInvalidEmail = 'is-invalid';
                                    //} else {
                                    //$isInvalidEmail = '';
                                    //}
                                    $isInvalidEmail = (session()->getFlashdata('errEmail')) ? 'is-invalid' : '';
                                    ?>
                                    <input type="email" class="form-control <?= $isInvalidEmail; ?>" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." autofocus>
                                    <?php
                                    if (session()->getFlashdata('errEmail')) {
                                        echo '<div id="validationServer03Feedback" class="invalid-feedback">
                                        ' . session()->getFlashdata('errEmail') . '
                                      </div>';
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $isInvalidPassword = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';
                                    ?>
                                    <input type="password" class="form-control <?= $isInvalidPassword; ?>" name='pass' id="password" placeholder="Password">
                                    <?php
                                    if (session()->getFlashdata('errPassword')) {
                                        echo '<div id="validationServer03Feedback" class="invalid-feedback">
                                        ' . session()->getFlashdata('errPassword') . '
                                      </div>';
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                                <?= form_close(); ?> <!-- Tutup form disini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>