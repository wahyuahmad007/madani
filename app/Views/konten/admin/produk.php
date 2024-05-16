<?= $this->extend('layout/admin/template') ?>

<?= $this->section('content') ?>


<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Produk',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
    </div>
    <div class="card o-hidden border-0 shadow-lg ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h6>Data produk</h6>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus-circle mr-2"></i>Tambah </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($produk as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nm_produk'] ?></td>
                                <td><?= $value['nm_kategori'] ?></td>
                                <td><?= rupiah($value['harga']) ?></td>
                                <td><?= $value['keterangan'] ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>admin/detail_produk/<?= $value['id_produk']; ?>" class="btn btn-sm btn-primary me-1"><i class="fas fa-bars m-1"></i><span>Detail</span></a>
                                    <a class="btn btn-success btn-sm dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opsi </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?= base_url(); ?>admin/edit_produk/<?= $value['id_produk']; ?>" class="btn btn-sm btn-warning m-1 "><i class="fas fa-edit m-1"></i><span>Edit</span></a>
                                            <a href="<?= base_url(); ?>admin/hapus_produk/<?= $value['id_produk']; ?>" class="btn btn-sm btn-danger m-1 hapus"><i class="fas fa-trash m-1"></i><span>Hapus</span></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!----modal input---->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="<?= base_url(); ?>admin/tambah_produk" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-m ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> <i class="fas fa-plus-circle"></i> Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <?php foreach ($kategori as $value) : ?>
                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nm_kategori']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="nama">nama produk</label>
                    <input type="text" class="form-control" name="nama" required autocapitalize="on">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="5" rows="3" required></textarea>
                    <label for="harga">harga</label>
                    <input type="number" class="form-control" name="harga" required>
                    <label for="gambar">gambar</label>
                    <input type="file" class="form-control" name="gambar" required>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-dismiss="modal"> <i class="fas fa-times-circle"></i> Batal</button>
                    <button type="submit" class="btn btn-success btn-sm"> <i class="fas fa-check-circle"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
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