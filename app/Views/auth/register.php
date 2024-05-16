<?= $this->extend('auth/template'); ?>

<?= $this->Section('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">


                <div class="container">
                    <h1 class="mt-5">Register Form</h1>
                    Silahkan Daftarkan Identitas Anda
                    <hr />
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <h4>Periksa Entrian Form</h4>
                            </hr />
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url(); ?>auth/process">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon" maxlength="12">
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_conf" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_conf" name="password_conf">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="<?= base_url(); ?>auth" class="btn btn-success">Kembali</a>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary float-end">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>



<?= $this->endSection('content'); ?>