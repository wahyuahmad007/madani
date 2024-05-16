<?= $this->extend('layout/template') ?>

<?= $this->section("content") ?>

<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="<?= base_url(); ?>asset/img/carousel-1.jpg" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Di Madani Backery & Cake</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Menerima pesanan kue dan roti untuk berbagai acara</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="<?= base_url(); ?>asset/img/carousel-2.jpg" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <h3 class="display-1 text-light mb-4 animated slideInDown">Kenapa harus kami?</h3>
                            <p class="text-light fs-5 mb-4 pb-3">Kami Membuat Setiap Produk Dengan Setulus Hati</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->







<!-- Product Start -->
<div class="container-xxl bg-light my-6 py-6 pt-0">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">Toko roti terbaik di kota anda</h1>
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
            <p class="text-primary text-uppercase mb-2">// Produk Kami</p>
            <h1 class="display-6 mb-4">Jelajahi Kategori Produk Roti Kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Rp20-Rp50</div>
                        <h3 class="mb-3">Roti Bolu</h3>
                        <span>Bebagai macam roti bolu <br>(bolu jala,donat,dll)</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="<?= base_url(); ?>asset/img/category1.jpg" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="<?= base_url(); ?>produk"><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp20-Rp50</div>
                        <h3 class="mb-3">Roti Sobek</h3>
                        <span>Berbagai macam roti sobek <br>(sobek keju,brownies,dll)</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="<?= base_url(); ?>asset/img/category2.jpeg" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="<?= base_url(); ?>produk"><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp20-Rp50</div>
                        <h4 class="mb-3">Roti Sisir</h4>
                        <span>Berbagai macam roti sisir <br>(sisir meses,manis selai,dll)</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="<?= base_url(); ?>asset/img/category3.png" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="<?= base_url(); ?>produk"><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product End -->

<!-- Team Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">Sosial Media</p>
            <h1 class="display-7 mb-4">follow dan like sosial media kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item text-center rounded overflow-hidden">
                    <img class="img-fluid" src="img/team-1.jpg" alt="">
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Faceebook</h5>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-square btn-light rounded-circle" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item text-center rounded overflow-hidden">
                    <img class="img-fluid" src="img/team-2.jpg" alt="">
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Intagram</h5>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-square btn-light rounded-circle" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item text-center rounded overflow-hidden">
                    <img class="img-fluid" src="img/team-3.jpg" alt="">
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Twitter</h5>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-square btn-light rounded-circle" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->





<?= $this->endsection('content') ?>