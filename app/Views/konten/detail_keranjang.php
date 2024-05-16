<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'keranjang belanja',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Keranjang</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active " aria-current="page">Keranjang</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl bg-light my-6 py-6 pt-0" style="margin: 12rem 0;">
    <div class="row">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="container  mt-3">
                        <div class="row d-flex align-items-baseline">
                            <div class="row">
                                <div class="col-xl-9">
                                    <h5><i class="fas fa-cart-arrow-down  fa-2x text-primary"></i>Detail Keranjang</h5>
                                </div>

                            </div>
                            <div class="container  mt-3">
                                <?php echo form_open('produk/update_keranjang'); ?>
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
                                                    <td><a href="<?= base_url(); ?>produk/hapus_keranjang/<?= $value['rowid']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <?php
                                    if ($tot_qty == 0) {
                                    ?>
                                        <div class="alert alert-primary" role="alert">
                                            Silahkan lakukan pembelian terlebih dahulu
                                        </div> <?php } else {
                                                ?>
                                        <div class="col-xl-10">
                                            <button type="submit" class="btn btn-primary text-capitalize" style="background-color:#FFD700;">Update</button>
                                        </div>

                                    <?php } ?>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-3" style="font-family: Arial, Helvetica, sans-serif;"> Total Harga</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="m-3" style="font-family: Arial, Helvetica, sans-serif;"><?= rupiah($total); ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    if ($tot_qty == 0) {
                    ?>

                        <a href="<?= base_url(); ?>produk"> <button class="btn btn-primary text-white mb-3 align-center ">Kembali</button></a>
                    <?php } else {
                    ?>
                        <a href="<?= base_url(); ?>Transaksi/invoice" class="btn btn-danger col-md-12">Lanjut Ke Pembayaran</a>
                    <?php } ?>


                </div>
            </div>
        </div>
    </div>
</div>
</div>









<div class="container">
    <div class="row g-4">
        <div class="table-responsive">

        </div>
    </div>
</div>





















</div>

<?= $this->endsection('content'); ?>
<!-- <?php
        function rupiah($angka)
        {

            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
        ?> -->