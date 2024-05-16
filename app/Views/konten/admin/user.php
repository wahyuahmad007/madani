<?= $this->extend('layout/admin/template') ?>

<?= $this->section('content') ?>


<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Akun',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
    </div>
    <div class="card o-hidden border-0 shadow-lg ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h6>Data Pengguna</h6>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url(); ?>admin/tambah_user"><button class="btn btn-sm btn-primary" ><i class="fas fa-plus-circle mr-2"></i>Tambah </button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Level</th>
                            <th>opsi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($user as $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['name']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>admin/hapus_user/<?= $value['id']; ?>" class="btn btn-sm btn-danger m-1 hapus"><i class="fas fa-trash m-1"></i><span>Hapus</span></a>
                                </td>
                            </tr>


                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama User</th>
                            <th>Level</th>
                            <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!----end of modal---->
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


<?php function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
} ?>
<?= $this->endsection('content') ?>