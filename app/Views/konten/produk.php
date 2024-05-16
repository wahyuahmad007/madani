<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Produk</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
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

<!-- end -->

<!-- Product Start -->
<div class="container-xxl bg-light my-6 py-6 pt-0" style="margin: 12rem 0;">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">Toko Roti Terbaik Di Kota Anda</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-inline-flex align-items-center text-start">
                        <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                        <div class="ms-4">
                            <p class="fs-5 fw-bold mb-0">Hubungi kami</p>
                            <p class="fs-1 fw-bold mb-0">085229343516</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">//Produk Roti</p>
            <h1 class="display-6 mb-4">Jelajahi Produk Roti Kami</h1>
        </div>
        <hr>
        <form class="d-flex wow fadeInUp pb-3" action="" method="get" data-wow-delay="0.5s">
            <?php $request = \Config\Services::request() ?>
            <input type="text" name="keyword" value="<?= $request->getGet('keyword'); ?>" class="form-control" style="width: 300pt;" placeholder="keyword">
            <button class="btn btn-primary ms-2" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="row g-4">
            <?php foreach ($produk as  $value) : ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <?php
                    echo form_open('produk/keranjang');
                    echo form_hidden('id', $value['id_produk']);
                    echo form_hidden('price', $value['harga']);
                    echo form_hidden('name', $value['nm_produk']);
                    echo form_hidden('keterangan', $value['keterangan']);
                    ?>
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3"><?= rupiah($value['harga']) ?></div>
                            <h3 class="mb-3"><?= $value['nm_produk'] ?></h3>
                            <span><?= $value['keterangan'] ?></span>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="<?= base_url() ?>asset/img/produk/<?= $value['gambar']; ?>" alt="">
                            <div class="product-overlay">

                                <?php if (session()->levels == '2') : ?>
                                    <button class="btn btn-lg-square btn-outline-light  m-4" type="submit"><span class="text-warning">Beli</span></button>






                                <?php else : ?>

                                    <a href="<?= base_url(); ?>auth" class="btn btn-lg-square btn-outline-light  m-4"><span class="text-warning">Beli</span></a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            <?php endforeach ?>
        </div>
        <div class=" text-center">
            <?= $pager->links('default', 'default_full') ?>
        </div>




    </div>
</div>
<!-- Product End -->


<?= $this->endsection('content'); ?>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>