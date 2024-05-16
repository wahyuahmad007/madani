<?= $this->extend('layout/admin/template') ?>


<?= $this->section('content') ?>
<div class="container">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
                title: 'Kategori',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card o-hidden border-0 shadow-lg ">
                <div class="card-shadow">
                    <div class="card-header bg-warning">
                        <h5>input kategori</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/add_kategori" method="post">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" autofocus>
                            <button class="btn btn-sm btn-success my-3" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card o-hidden border-0 shadow-lg ">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($kategori as $key => $value) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $value['nm_kategori'] ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>admin/hapus_kategori/<?= $value['id_kategori']; ?>" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash me-2"> Hapus </i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>opsi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
        const href = this.href
        Swal.fire({
            title: 'Apakah yakin  ',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })

    })
</script>

<?= $this->endsection('content') ?>