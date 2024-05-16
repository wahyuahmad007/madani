<?= $this->extend('layout/admin/template') ?>

<?= $this->section('content') ?>


<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Server Key',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Server Key</h1>
        <hr>
    </div>
    <div class="card col-md-6 bg-warning">
        <div class="card-body ">
            <?php foreach ($server as $key) : ?>
                <form action="<?= site_url('admin/server_edit'); ?>/<?= $key['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <label for="server">Server Key</label>
                    <input type="text" class="form-control" name="server" value="<?= $key['server_key']; ?>">
                    <label for="server" class="mt-3">Client Key</label>
                    <input type="text" class="form-control " name="client" value="<?= $key['client_key']; ?>">
                    <button class="btn  btn-success mt-3" type="submit">Edit</button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>



<?= $this->endsection('content') ?>