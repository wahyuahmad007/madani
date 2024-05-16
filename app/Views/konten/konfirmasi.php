<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3"></h1>
        <nav aria-label="breadcrumb animated slideInDown">
        </nav>
    </div>
</div>
<div class="container-xxl py-6 mt-6">
    <div class="container">
        <div class="card col-lg-8  offset-2">
            <div class="alert alert-light " role="alert">
                <h3 style="color:brown;">Madani Backery & Cake</h3>
                <br><br>

                <h5 style="font-family:Arial, Helvetica, sans-serif;">Tagihan Pembayaran Berhasil Ditambahkan!</h5>
                <hr>

                <p>Hai <?= session()->username; ?></p>
                <p>Terima kasih telah berbelanja di toko roti Madani Backery & Cake mohon segera lakukan pembayaran. <a href="<?= base_url(); ?>Transaksi/histori">Lihat Transaksi</a> </p>

            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content'); ?>