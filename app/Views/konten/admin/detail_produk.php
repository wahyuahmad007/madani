<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($detail as $value) : ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body border text-center">
                        <img src="<?= base_url(); ?>asset/img/produk/<?= $value['gambar']; ?>" alt="" class="card-img-top" style="aspect-ratio: 0,5 / 1">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-primary">
                        <h4>Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <tr>
                                    <td>Nama Produk</td>
                                    <td>:</td>
                                    <td><?= $value['nm_produk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td><?= $value['nm_kategori']; ?></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><?= rupiah($value['harga']); ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?= $value['keterangan']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <a href="<?= base_url(); ?>admin/produk"><button class="btn btn-sm btn-danger"> <i class="fas fa-arrow-left"></i> Kembali</button></a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<?php function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
} ?>


<?= $this->endsection('content'); ?>