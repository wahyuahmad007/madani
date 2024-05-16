<?= $this->extend('layout/admin/template'); ?>


<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Transaksi',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penjualan</h1>
    </div>
    <a href="<?= base_url(); ?>admin/penjualan"><button class="btn btn-sm btn-danger mb-3">Kembali</button></a>
    <div class="card">
        <div class="card-shadow">
            <form action="<?= site_url('Transaksi/tunai'); ?>" method="Post">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Nota</label>
                            <input type="text" name="kode" class="form-control" value="<?= $kode; ?>" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Customer</label>
                            <input type="text" name="customer" id="nama" class="form-control" required value="Tunai" readonly>
                        </div>

                        <div class="col-md-3 mt-4">
                            <button class="btn btn-sm btn-success mt-2" type="submit" id="tombolPay"><i class="fas fa-save mr-2"></i>Bayar </button>
                        </div>
                        <input type="text" name="nomer" value="0" id="nomor" hidden>
                        <input type="text" name="alamat" value="0" id="alamat" hidden>
                        <input type="text" name="status" value="diterima" id="status" hidden>
                    </div>
                </div>
            </form>

            <div class="card-body">
                <div class="container  mt-3">
                    <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus-circle mr-2"></i>Tambah </button>
                    <?php echo form_open('admin/update_keranjang'); ?>
                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col" width='80px;'>Qty</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tot_qty = 0;
                                $i = 1;
                                $total = 0;
                                foreach ($cart->contents() as $value) :
                                    $tot_qty = $tot_qty + $value['qty'];
                                    $total = $total + $value['subtotal'];
                                ?>
                                    <tr>
                                        <td><input type="number" name="qty<?= $i++; ?>" class="form-control" value="<?= $value['qty']; ?>"></td>
                                        <td><?= $value['name']; ?></td>
                                        <td><?= rupiah($value['price']); ?></td>
                                        <td><?= rupiah($value['subtotal']); ?></td>
                                        <td><a href="<?= base_url(); ?>admin/hapus_keranjang/<?= $value['rowid']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-warning col-md-2 text-white " type="submit">Update</button>
                    <hr>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!----modal input---->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-m ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> <i class="fas fa-plus-circle"></i> Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="table-responsive">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $value) : ?>
                                <?php
                                echo form_open('admin/tambah_penjualan');
                                echo form_hidden('id', $value['id_produk']);
                                echo form_hidden('price', $value['harga']);
                                echo form_hidden('name', $value['nm_produk']);
                                echo form_hidden('keterangan', $value['keterangan']);
                                ?>
                                <tr>
                                    <td><?= $value['nm_produk']; ?></td>
                                    <td><?= rupiah($value['harga']); ?></td>
                                    <td><button type="submit" class="btn btn-primary btn-sm">Pilih</button></td>
                                </tr>
                                <?= form_close() ?>

                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>opsi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
            </div>
        </div>
    </div>
</div>
<!----end of modal---->









<?= $this->endsection('content'); ?>
<!-- <?php
        function rupiah($angka)
        {

            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
        ?> -->